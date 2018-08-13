<?php

namespace App\Http\Controllers;

use App\Mail\TextEmail;
use App\Model\Advertistment;
use App\Model\PageTitle;
use App\Model\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Mail;

class RoomController extends Controller
{
    //


    public function getRoomDetail($id)
    {

        $room = Room::where('id',$id)->where('status','=','ap')->first();
        if (!$room) {
            setDanger("Ruangan tidak ditemukan");
            return redirect("/");
        }

        $room->setDefaultPreference();
        $data = [];
        $data["room"] = $room;
        $data["isMyRoom"] = Auth::check() && Auth::user()->id == $room->user_id;
        /** @var \App\Model\PageTitle $pageTitle */
        $data['title'] = "Detail ruangan $room->buildingName";
        $data['description'] = "Ruangan untuk disewakan $room->buildingName, $room->roomName. Untuk keperluan $room->roomFunction, di $room->city, $room->address";
//        debug($data);



        $data['advertisements'] = getAdvertisement($room->city);
        return view('home.detailRoom', $data);
    }

    public function anyRoomModule(Request $request)
    {
        /** @var \App\Model\Room $room */
        /** @var \App\User $userRoom */

        $eol = PHP_EOL;
        $post = (object)$request->all();
        $user = Auth::user();


        if ($request->is('api/*')) {
            $response = getDefaultResponse();
            $response->message = "Room fetched";

//
            //region #submitApprove
            if(isset($post->cmd) && $post->cmd == 'approve'){
                $room = $user->getRooms->where('id','=',$post->id)->first();
                if($room){
                    $response->isSuccess = true;
                    $response->message = "Room approval updated";
                    $userRoom = $room->getUser->first();
                    $subject = "";
                    $message = "";
                    if($post->status =='ap'){
                        $subject = "Penerimaan pengajuan ruangan baru";
                        $message = "<p>Halo $userRoom->name, kami telah menyetujui ruangan anda untuk dipublikasikan dengan detail sebagai berikut</p>
                            <p>Ruangan: $room->roomName<br/>Alamat: $room->address<br/>Gedung: $room->buildingName</p>
                        ";
                    }else if($post->status == 're'){
                        $subject = "Penolakan pengajuan ruangan baru";
                        $message = "<p>Halo $userRoom->name, kami menolak ruangan anda untuk dipublikasikan dengan detail sebagai berikut</p>
                            <p>Ruangan: $room->roomName<br/>Alamat: $room->address<br/>Gedung: $room->buildingName</p>
                        ";
                    }

                    if(isset($post->statusReason) && $post->statusReason!=""){
                        $message .= "<p>Pesan tambahan <br/>$post->statusReason</p>";
                    }


                    try{
                        if(IS_SERVER){
                            Mail::to($userRoom->email)->queue(new TextEmail($message,$subject));
                        }

                    }catch(Exception $e){

                    }
                    $room->update((array)$post);
                    $response->data->email = $message;

                }else{
                    $response->isSuccess = false;
                    $response->message = "User does not have this room";

                }

                return response()->json($response);

            }
            //endregion

            //region #filter
            $response->data->filter = [
                "cmbStatus" => [
                    ["key" => "--All--", "value" => ""],
                    ["key" => "Pending Approval", "value" => "pa"],
                    ["key" => "Approved", "value" => "ap"],
                    ["key" => "Rejected", "value" => "re"],
                ]
            ];
            //endregion

            //region #roomData
            $rooms = Room::where('id', '!=', '-1');
            if (isset($post->cmbStatus) && $post->cmbStatus != "") {
                $rooms->where('status', '=', $post->cmbStatus);
            }

            $rooms->orderBy('created_at','desc');;
            $rooms = $rooms->paginate(PER_PAGE);
            $rooms->appends(Input::except('page'));
            foreach ($rooms as $room) {
                $room->status = getReadableStatus($room->status);
                $room->getPrices;
                $user = $room->getUser;
                $room->getPhotos;
                $room->imagePath = $room->getImagePath($user);
                $room->mainPhoto = $room->getPhotos->where('isMain', true)->first();
            }
            $response->data->rooms = $rooms;
            //endregion

            //region #formApproval
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
