<?php

namespace App\Http\Controllers;

use App\Model\Advertistment;
use App\Model\City;
use App\Model\PageTitle;
use App\Model\Photo;
use App\Model\Prices;
use App\Model\PriceUnit;
use App\Model\Room;
use App\User as User;
use CForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use phpDocumentor\Reflection\Types\Nullable;


class MemberController extends Controller
{
    //

    public $forms;

    public function __construct(){
        $this->middleware("auth");
    }

    public function getMyRoom(){

        $data = [];
        $data['active'] = 0;
        $data['isEdit'] = false;
        $data['rooms'] = Auth::user()->getRooms->all();
        $data['forms'] = $this->setupNewForms();
//        debug(Auth::user()->getRooms);
        /** @var \App\Model\PageTitle $pageTitle */
        $pageTitle = PageTitle::where('page','=','list ruangan')->first();
        $data['title'] = $pageTitle->title;
        $data['description'] = $pageTitle->description;
        return view('member.room.master',$data);
    }

    public function getMyProfile(){

        $data = [];

        $data['forms'] = $this->setupProfileForm();

        $data['title'] = "Edit Profile | Sewa Ruang";
        $data['description'] = "";
        return view('member.editProfile.master',$data);
    }

    public function postEditProfile(Request $request){

        $user = Auth::user();

        $user->update($request->all());
        $user->save();

        setSuccess("Profile berhasil di-update");
        return redirect()->back();
    }

    public function getMyAdvertisement(){
        $data = [];
        $data['active'] = 0;
        $data['isEdit'] = false;
        $data['advertisements'] = Auth::user()->getRooms->all();
        $data['advertisementForms'] = $this->setupNewForms();
    }



    public function getEditMyRoom($id = -1){
        /** @var User $user */
        if($id ==-1){
            return redirect('');
        }

        //# bukan miliknya redirect
        $user = Auth::user();
        $currentRoom = $user->getRooms->where("id",'=',$id)->first();
        if(!$currentRoom){
            return redirect('');
        }

        $data = [];
        $data['room'] = $currentRoom;
        $data['isEdit'] = true;
        $data['forms'] = $this->setupNewForms($currentRoom);
        return view('member.room.master',$data);
    }

    public function postAddRoom(Request $request){
        /**
         * @var Room $room;
         */
        $post = (object) $request->all();
        $name = str_random();

//        debug($post);
//        debug($post);

        $validate = [
            "roomName" => "required",
            "buildingName" => "required",
            "address" => "required",
            "photo" => "array",
            "photo.*" => "max:5000|mimes:jpeg,bmp,png",
            "city" => "required",

            "roomFunction" => "required",
            "capacityClass" => "required|numeric",
            "capacityUShape" => "required|numeric",
            "capacityTheatre" => "required|numeric",
            "area"=> "required",
            "providerTelephone" => "required",
            "mainPrice" => "required",
            "mainPriceUnit" => "required"
        ];

        if($post->cmd == 'add'){
            $validate = array_merge($validate,["mainPrice" => "required",
                "mainPhoto" => "required|max:5000",]);
        }
        $this->validate($request,$validate);





        $room = null;
        $user = Auth::user();
        foreach ($post as $key=>$content){
            if($key != 'price' && $key!= 'deletePhoto'){
                $post->$key = getSemicolonFormat($content);

            }
        }
//                debug($post);

        if($post->cmd == 'add'){



            $room = new Room((array)$post );
            $room->status = 'pa';
            $room->getUser()->associate($user);


            $room->save();
//            return redirect()->back();



        }else if($post->cmd =='edit' && $post->id != '-1' ){
            $room = Room::find($post->id);
            if(isset($post->deletePhoto)){
                foreach($post->deletePhoto as $idDelete){
                    $targetDelete = $room->getPhotos->where('id',$idDelete)->first();
                    if($targetDelete){
                        $targetDelete->delete();
                    }
                }
            }
            if(!$room || $room->user_id != $user->id){
                setDanger("This post not belong to you");
                return redirect('');
            }




            $room->update((array)$post);
//            $room->getPhotos()->delete();

        }

        if(isset($post->price)){
            foreach($post->price as $key=>$price){
                $prices = $room->getPrices->where('unit',$key)->first();
                $priceUnit  = PriceUnit::where('name',$key)->first();
                if(!$priceUnit){
                    break;
                }
                if($prices){
                    $prices->price =  $price;
                    $prices->save();
                }else{
                    $prices = new Prices();
                    $prices->unit = $key;
                    $prices->price = $price;
                    $prices->getRoom()->associate($room);
                    $prices->save();
                }

            }

        }


        if($request->hasFile('photo')){
//            debug($post);
            foreach ($request->file('photo') as $currentPhoto){


                $photo = savePhoto($currentPhoto,$room->getImagePath($user,true));
//                $photo->
                $photo->getRoom()->associate($room);
                $photo->save();

            }
        }

        if($request->hasFile('mainPhoto')){
            if($post->cmd=='edit'){
                $room->getPhotos()->where('isMain',true)->delete();
            }
            $mainPhoto = $request->file('mainPhoto');
            $photo = savePhoto($mainPhoto,$room->getImagePath($user,true));
            $photo->isMain = true;
            $photo->getRoom()->associate($room);
            $photo->save();
        }



//        debug($post->foto);
        $message = $post->cmd == "add" ? "Ruangan telah berhasil dimasukan" : "Ruangan telah berhasil diupdate";
        setSuccess("$message");

        return redirect(route('get.roomDetail',[$room->id]));
    }




    public function setupProfileForm(){

        //'name', 'email', 'password',"city","telephone","isVerified","verifyKey", "reset",
        $user = Auth::user();

        $name = new CForm("name",'name');
        $name->setModel($user);
        $name->isRequired = true;

        $telephone = new CForm("telephone",'telephone');
        $telephone->setModel($user);
        $telephone->isRequired = true;

        return [$name, $telephone];

    }

    public function setupNewForms( Room  $model=null){

        /**
         * @var Photo $mainPhoto;
         */

        $cmd = new CForm("cmd",'cmd');
        $cmd->isHidden = true;
        $cmd->isRequired = true;
        $cmd->value = $model == NULL ? "add" : "edit";

        $id = new CForm("id",'id');
        $id->isHidden = true;
        $id->isRequired = true;
        $id->value = $model == NULL ? "-1" : $model->id;


        $roomName = new CForm("Nama Ruangan", "roomName");
        $roomName->setModel( $model);
        $roomName->isRequired = true;


        $buildingName = new CForm("Nama Gedung / Hotel", "buildingName");
        $buildingName->setModel( $model);
        $buildingName->isRequired = true;
        
        
        $address = new CForm("Alamat Gedung","address");
        $address->isRequired = true;
        $address->setModel( $model);

        
        
        $city = new CForm("Kota Alamat", "city");
        $city->setModel( $model);
        $city->isRequired = true;
//        $city->setInputTypeSelect([], City::orderBy("name","asc")->get());
        
        $function = new CForm("Fungsi Ruang","roomFunction");
//        $function->isRequired = true;
        $function->setModel( $model);
        $function->setInputTypeCheckbox([],\App\Model\FungsiRuang::all());

        $titleCapacity = new CForm("t","t");
        $titleCapacity->titleTop = "Kapasitas orang: ";
        $capacityClass = new CForm("Kelas","capacityClass","number");
        $capacityClass->placeholder = "Jumlah";
        $capacityClass->isRequired = true;
        $capacityClass->setModel( $model);
        $capacityClass->cssContainer = "display:inline-block;margin-left:6px;";
//        $capacityClass->bottomDescription = '
//        <div>
//             <input style="max-width: 150px;" placeholder="Jenis Teater" id="capacityTheatre" class="input-block-level" required="" name="capacityTheatre" value="" type="number">
//        </div>
//
//        <div>
//            <input style="max-width: 150px;" placeholder="Jenis U Shape" id="capacityTheatre" class="input-block-level" required="" name="capacityTheatre" value="" type="number">
//        </div>
//        ';

        $capacityUShape = new CForm("U-Shape","capacityUShape","number");
        $capacityUShape->placeholder = "Jumlah";
        $capacityUShape->isRequired = true;
        $capacityUShape->setModel( $model);
        $capacityUShape->cssContainer = "margin-top:-26px;";
        $capacityUShape->cssContainer = "display:inline-block;margin-left:6px;;";

        $capacityTheatre = new CForm("Teater","capacityTheatre","number");
        $capacityTheatre->placeholder = "Jumlah";
        $capacityTheatre->isRequired = true;
        $capacityTheatre->setModel( $model);
//        $capacityTheatre->cssContainer = "margin-top:-26px;";
        $capacityTheatre->cssContainer = "display:inline-block;margin-left:6px;;";



        $area = new CForm("Ruang Luas (m2)","area","number");
        $area->isRequired = true;
        $area->setModel( $model);


        $totalRoom = new CForm("Jumlah ruang", "totalRoom","number");
        $totalRoom->setModel( $model);

        $facility = new CForm("Fasilitas","facility");
        $facility->setModel( $model);
        //$facility->value = "LCD;wi-fi";
        $facility->setInputTypeCheckbox([],\App\Model\Facility::all());
        
        $caterings = new CForm("Katering","caterings");
        $caterings->setModel( $model);
        $caterings->setInputTypeCheckbox([],\App\Model\Catering::all());
        
        
        $parking = new CForm("Estimasi Parkir","parking","number");
        $parking->setModel( $model);

        $providerTelephone = new CForm("No Telephone", "providerTelephone","tel");
        $providerTelephone->value = Auth::user()->telephone;
        $providerTelephone->setModel( $model);

        $mainPrice = new CForm("Harga","mainPrice","number");
        $mainPrice->isRequired = true;
        $mainPrice->setModel( $model);
        $mainPrice->cssContainer = 'display:inline-block;';

        $mainPriceUnit = new CForm("Satuan","mainPriceUnit");
        $mainPriceUnit->isRequired = true;
        $mainPriceUnit->setModel( $model);
        $mainPriceUnit->cssContainer = 'display:inline-block;';
        $mainPriceUnit->setInputTypeSelect([],PriceUnit::all());


        $description = new CForm("Deskripsi Tambahan","description","textarea");
        $description->isRequired = false;
        $description->setModel( $model);


        $photo = new CForm("Foto utama wajib","mainPhoto","file");
        $photo->isRequired = $model == NULL;
        $photo->setModel( $model);
        $additionalForm = [];

        if($model != NULL){
            $mainPhoto =  $model->getPhotos->where('isMain',true)->first();
            $photo->bottomDescription .= "<div><a class=\"image-link\" href='{$mainPhoto->getLarge()}'><img  style='max-height: 200px;' src='{$mainPhoto->getSmall()}'></a></div>";
//            foreach($model->getPhotos->where('isMain',false)->all() as $additionalPhotoModel){
//                $additionalPhoto = new CForm("Ganti Gambar","");
////                $additionalPhoto->
//                $additionalPhoto->isArray = true;
//                $additionalPhoto->bottomDescription .= "<div><a target='_blank' href='{$additionalPhotoModel->getLarge()}'><img style='max-height: 200px;' src='{$additionalPhotoModel->getSmall()}'></a></div>";
//                $additionalForm[] = $additionalPhoto;
//            }

        }



        $prices = [];
        foreach(PriceUnit::all() as $price){

            $priceForm = new CForm("Harga per $price->name","price[$price->name]","number");
            if($model != NULL){
                $roomPrice = $model->getPrices->where('unit',$price->name)->first();

                if($roomPrice){
                    $priceForm->value = $roomPrice->price;
                }
            }
            $prices[] = $priceForm;

        }




        $latitude = New CForm("Location coordinate Latitude","latitude");
        $latitude->setModel($model);
        $longitude = New CForm("Location coordinate Longitude","latitude");
        $longitude->setModel($model);

        $longitude->cssContainer = "display:inline-block;margin-left:6px;";
        $latitude->cssContainer = "display:inline-block;margin-left:6px;";



        return  array_merge([$cmd,$id, $roomName, $buildingName, $address, $city,$function, $titleCapacity, $capacityClass, $capacityUShape, $capacityTheatre, $area,$totalRoom,$facility,$caterings,$parking,$providerTelephone,$mainPrice,$mainPriceUnit, $latitude, $longitude],[$description,$photo],
            $additionalForm);

    }



}
