<?php

namespace App\Http\Controllers;

use App\Mail\TextEmail;
use App\Model\Advertistment;
use App\Model\AdvertistmentHistoryDescription;
use App\Model\AdvertistmentPayment;
use App\Model\AdvertistmentPeriod;
use App\Model\City;
use App\Model\PageTitle;
use App\Model\SelectAdvertisementType;
use App\User;
use Auth;
use CForm;
use DateTime;
use http\Exception;
use Illuminate\Http\Request;
use Mail;


class AdvertisementController extends Controller
{
    public $data = [];

    public function __constructor()
    {

        $this->middleware('auth');
        $this->data['title'] = "Iklan";


    }

    public function getMyAdvertisement()
    {

        /**
         * @var User $user ;
         */
        $this->middleware('auth');

        $user = Auth::user();
        $this->data['forms'] = $this->setupAdvertisementForms();


        $this->data['advertisements'] = $user->getAdvertistments->all();
        $this->data['isEdit'] = false;
        /** @var \App\Model\PageTitle $pageTitle */
        $pageTitle = PageTitle::where('page', '=', 'tambah iklan')->first();
        $this->data['title'] = $pageTitle->title;
        $this->data['description'] = $pageTitle->description;
        return view('advertisement.myAdvertisement.myAdvertisementMaster', $this->data);


    }

    public function setupAdvertisementForms(Advertistment $model = null)
    {

        $isActive = false;



        $cmd = new CForm("cmd", 'cmd');
        $cmd->isHidden = true;
        $cmd->isRequired = true;
        $cmd->value = $model == NULL ? "add" : "edit";

        $id = new CForm("id", 'id');
        $id->setModel($model);

        $id->isHidden = true;
        $id->isRequired = true;
        $id->value = $model == NULL ? "-1" : $model->id;


        $photo = new CForm('Photo', 'photo');
        $photo->setModel($model);
        $photo->isRequired = $model == NULL;
        $photo->setInputTypePhoto();
        $photo->bottomDescription = "";
        $photo->bottomDescription .= $model == null ? "Foto ini akan ditampilkan dalam kolom iklan" : "
         <img style='max-height: 200px;' src='{$model->getPhoto->getSmall()}'/>
         <br/><b>Silahkan pilih gambar baru jika ingin mengganti foto. Foto sebelum nya akan dihapus
            
        ";
        $photo->isDisabled = $isActive;


        $type = new CForm("Jenis Iklan", "advertisementType");
        $type->setModel($model);
        $type->setInputTypeSelect([],SelectAdvertisementType::all());
        $type->isRequired = true;
        if ($model) {
            $type->isDisabled = true;
        }



        $description = new CForm("Deskripsi iklan", "description");
        $description->setModel($model);

        $description->isRequired = true;
        $description->isDisabled = $isActive;

        $link = new CForm("Link iklan ", "link");
        $link->setModel($model);
        $link->isRequired = true;
        $link->bottomDescription = "Link iklan yang dituju ketika user menekan. contoh format link: <b>www.google.com</b>";

        $targetCity = new CForm("Target iklan untuk kota", "targetCity");
        $targetCity->setModel($model);
        $targetCity->isRequired = true;
//        $targetCity->setInputTypeSelect([], City::all());
        $targetCity->bottomDescription = "Iklan akan ditampilkan sesuai dengan lokasi ruangan";
        if ($model) {
            $targetCity->isDisabled = true;
        }


        $duration = new CForm("Durasi iklan", "duration");
//        $duration->setGone(true);
        $duration->setModel($model);
        $duration->isRequired = true;
        if ($model) {
            $duration->isHidden = true;
        }
        $duration->setInputTypeSelect([], AdvertistmentPeriod::all());
        $bottom = "";
        foreach (AdvertistmentPeriod::all() as $period) {
            $period->setDefaultPreference();
            $bottom .= "<p>$period->name: $period->price  </p>";
        }

        $duration->bottomDescription = $bottom;

        return [$cmd, $id, $photo, $type, $description, $link, $targetCity, $duration];
    }

    public function postAdvertisementForm(Request $request)
    {


        $this->middleware('auth');
        $user = Auth::user();
        $post = (object)$request->all();
        $request->merge(['targetCity' => strtolower($request->get('targetCity') ?? "xx")]);



        $this->validate($request,[
           'photo'=>'max:5000',
           'advertisementType'=>'required',
           'targetCity'=> 'exists:city,name'
        ]);

        $post->targetCity =             $post->targetCity ? strtolower($post->targetCity) : "xx";


        $advertisement = null;
        if ($post->cmd == 'add') {

//            debug($post);
            $period = AdvertistmentPeriod::where('name', '=', $post->duration)->first();

            if (!$period) {
                setDanger("Price not found");
                return redirect('');
            }

            $city = City::where('name', $post->targetCity)->first();
            $advertisementType = SelectAdvertisementType::where('name',$post->advertisementType)->first();

            if(!$city){
                setDanger("Kota tidak terdaftar");
                return redirect()->back();
            }
            if(!$advertisementType){
                setDanger("Tipe iklan tidak terdaftar ");
                return redirect()->back();
            }

            $maximum = 1 ;
            $isNotValid = Advertistment::where('targetCity',$post->targetCity)
                    ->where('status','=','ap')
                    ->where('select_advertisement_type_id',$advertisementType->id)
                    ->count() >= $maximum;

            if($isNotValid){
                setDanger("Kategori $advertisementType->name di Kota $post->targetCity telah memenuhi kuota. User lain telah memasang iklan terlebih dahulu");
                return redirect()->back();
            }



            //# save appliance
            $advertisement = new Advertistment((array)$post);
            $advertisement->viewed = 0;
            $advertisement->status = "pa";
            $advertisement->getUser()->associate($user);
            $advertisement->getAdvertisementType()->associate($advertisementType);
            $advertisement->save();

            if ($request->hasFile('photo')) {
                $mainPhoto = $request->file('photo');
                $photo = savePhoto($mainPhoto, $advertisement->getAdvertisementPath($user, true));
                $photo->isMain = true;
                $photo->getAdvertisement()->associate($advertisement);
                $photo->save();
            }


            //# save history
            /** @var  \App\Model\AdvertistmentHistoryDescription $advertisementHistory */
            $advertisementHistory = new AdvertistmentHistoryDescription();
            $advertisementHistory->status = 'pa';
            $advertisementHistory->description = "Pertama kali melakukan pengajuan pemasangan iklan";
            $advertisementHistory->getAdvertisement()->associate($advertisement);
            $advertisementHistory->invoice = strtolower(str_random(2)) . rand(10000, 99999);
            $advertisementHistory->price = $period->price;
            $advertisementHistory->duration = $period->value;
            $advertisementHistory->save();


            $this->data['advertisement'] = $advertisement;
            $this->data['advertisementHistory'] = $advertisementHistory;

            return view('advertisement.myAdvertisement.newStep2', $this->data);
        } else if ($post->cmd == 'edit') {
            $advertisement = Advertistment::where('id', $post->id)->where('user_id', $user->id)->first();
            if (!$advertisement) {
                setDanger("Iklan tidak ditemukan");
                return redirect('');
            }

            if($advertisement->getIsActive()){
                setDanger("Iklan status aktif, tidak dapat diedit");
                return redirect('');
            }

            if ($request->hasFile('photo')) {
                $advertisement->getPhoto->delete();
                $mainPhoto = $request->file('photo');
                $photo = savePhoto($mainPhoto, $advertisement->getAdvertisementPath($user, true));
                $photo->isMain = true;
                $photo->getAdvertisement()->associate($advertisement);
                $photo->save();
            }

            $advertisement->update($request->all());

            setSuccess("Iklan berhasil di update");
            return redirect(route('get.advertisementDetail', [$advertisement->id]));

        }


    }


    public function getAdvertisementDetail($id, Request $request)
    {
        /**
         * @var User $user ;
         */
        $this->middleware('auth');

        $user = Auth::user();
        $advertisement = Advertistment::find($id);
        if ($advertisement->user_id != $user->id) {
            return redirect('');
        }


        $this->data['advertisement'] = $advertisement;

        return view('advertisement.myAdvertisement.detailAdvertisement', $this->data);
    }

    public function getAdvertisementPayment()
    {


        return view('advertisement.advertisementPayment');

    }

    public function postAdvertisementPayment(Request $request)
    {

        $this->middleware('auth');

        $user = Auth::user();
        $post = (object)$request->all();

        $this->validate($request, [
            "invoice" => 'required',
            "photo" => "file|max:5000|mimes:jpeg,bmp,png",
            "captcha" => "captcha",
        ]);

        $advertisementHistory = AdvertistmentHistoryDescription::where('invoice', '=', $post->invoice)
            ->where('status', 'pa')->first();
        if (!$advertisementHistory) {
            setDanger("salah memasukan nomer invoice");
            return redirect()->back();
        }

        $payment = new AdvertistmentPayment((array)$post);
        $payment->save();

        if ($request->hasFile('photo')) {
            $mainPhoto = $request->file('photo');
            $photo = savePhoto($mainPhoto, $payment->getPaymentImagePath($user));
            $photo->isMain = true;
            $photo->getAdvertistmentPayment()->associate($payment);
            $photo->save();
        }


//        return redirect(route('get.advertisementDetail',[$advertisementHistory->getAdvertisement()->id]));

        $advertisementHistory->save();
        setSuccess("Konfirmasi dengan nomer invoice $advertisementHistory->invoice sedang dalam proses, Mohon tunggu");

        if (Auth::check()) {
            $advertisement = $advertisementHistory->getAdvertisement;

            return redirect(route('get.advertisementDetail', [$advertisement->id]));
        }
        return redirect('');

    }


    public function getEditAdvertisement($id, Request $request)
    {

        /**
         * @var Advertistment $advertisement ;
         */
        $this->middleware('auth');
        $user = Auth::user();
        $advertisement = Advertistment::where('id', $id)->where('user_id', '=', $user->id)->first();

        if (!$advertisement) {
            setDanger('Iklan ini tidak ditemukan');
            return redirect('');
        }


//        debug($this->setupAdvertisementForms($advertisement));

        $this->data['forms'] = $this->setupAdvertisementForms($advertisement);
        $this->data['isEdit'] = true;
        $this->data['advertisement'] = $advertisement;
        return view('advertisement.myAdvertisement.myAdvertisementMaster', $this->data);


    }


    public function anyAdvertisementModule(Request $request)
    {
        $post = (object)$request->all();

        $response = getDefaultResponse();
        if ($request->is('api/*')) {


            //region approval
            if (isset($post->cmd) && $post->cmd == 'approve') {
                $advertisementHistoryDescription = AdvertistmentHistoryDescription::find($post->id);
                if (!$post->id) {
                    $response->isSuccess = false;
                    $response->message = "id Not found";
                    return response()->json($response);

                }


                $advertisementHistoryDescription->status = $post->status;
                /** @var \App\Model\Advertistment $advertisement */
                $advertisement = $advertisementHistoryDescription->getAdvertisement;
                $advertisement->status =  $post->status;
                if ($post->status == 'ap') {
                    $time = new DateTime("now + {$advertisementHistoryDescription->duration} day");
                    $advertisement->validUntil = (getDefaultDatetime($time->format('Y-m-d H:i:s')));
                }

                $advertisement->save();
                $advertisementHistoryDescription->save();


                if ($post->status == 'ap') {
                    $subject = "Penerimaan pengajuan iklan baru";
                    $message = "<p>Hal, kami telah menyetujui iklan anda untuk dipublikasikan dengan detail sebagai berikut</p>
                            <p>Link: $advertisement->link <br/>
                        ";
                } else if ($post->status == 're') {
                    $subject = "Penolakan pengajuan iklan baru";
                    $message = "<p>Hal, kami menolak iklan anda untuk dipublikasikan dengan detail sebagai berikut</p>
                            <p>Link: $advertisement->link <br/>";
                }

                if (isset($post->statusReason) && $post->statusReason != "") {
                    $message .= "<p>Pesan tambahan <br/>$post->statusReason</p>";
                }

                /** @var User $userAdvertisement */
                $userAdvertisement = $advertisement->getUser;
                $response->data->email = $message;
                try {

                    if(IS_SERVER){
                        $userAdvertisement->sendEmail($subject,$message);

                    }

                } catch (Exception $e) {

                }


                return response()->json($response);
            }

            //endregion


            //region data
            /** @var \App\Model\AdvertistmentHistoryDescription $descriptionAdvertisements */
            /** @var \App\Model\AdvertistmentHistoryDescription $descriptionAdvertisement */
            $descriptionAdvertisements = AdvertistmentHistoryDescription::where('status', 'pa')->get()->keyBy('id');

            //splicing non payment
            foreach ($descriptionAdvertisements as $descriptionAdvertisement) {
                if ($descriptionAdvertisement->getPayment()->count() < 1) {
                    $descriptionAdvertisements->forget($descriptionAdvertisement->id);
                } else {
                    $descriptionAdvertisement->setDefaultPreference();
                    $advertisement = $descriptionAdvertisement->getAdvertisement;
                    $advertisement->getUser;
                    $advertisement->getPhoto;
                    $payments = $descriptionAdvertisement->getPayment();
                    foreach ($payments as $payment) {
                        $payment->getPhoto;
                    }
                    $descriptionAdvertisement->payments = $payments;
                }

            }
            $array = [];
            foreach ($descriptionAdvertisements as $key => $value) {
                $array[] = $value;
            }
            $response->data->advertisementDescription = $array;

            $activeAdvertisements = Advertistment::where('validUntil', '>=', getDefaultDatetime(null,'Y-m-d'))
                ->orderBy('targetCity')
                ->get();
//                ->sortBy('targetCity');
            foreach($activeAdvertisements as $activeAdvertisement){
                $activeAdvertisement->getPhoto;
                $activeAdvertisement->getUser;
            }
            $response->data->activeAdvertisement = $activeAdvertisements;


                //endregion


            //region approveForm
            $response->data->approveForm['status'] = [
                [
                    "key" => "Approve (disetujui)", "value" => "ap"
                ],
                [
                    "key" => "Reject (ditolak)", "value" => "re"
                ],
            ];
            //endregion
            return response()->json($response);
        }
    }

}
