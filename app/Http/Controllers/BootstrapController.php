<?php

namespace App\Http\Controllers;

use App\Model\AdvertistmentHistoryDescription;
use App\Model\Room;
use Auth;
use Illuminate\Http\Request;

class BootstrapController extends Controller
{
    //

    public function anyNotification(Request $request){
        $post = (object) $request->all();

        if($request->is('api/*')){
            $response = getDefaultResponse();
            $response->message = "Notification Fetched";


            $descriptionAdvertisements = AdvertistmentHistoryDescription::where('status', 'pa')->get()->keyBy('id');
            foreach ($descriptionAdvertisements as $descriptionAdvertisement) {
                if ($descriptionAdvertisement->getPayment()->count() < 1) {
                    $descriptionAdvertisements->forget($descriptionAdvertisement->id);
                }
            }
            $advertisementCount = sizeof($descriptionAdvertisements);


            $response->data->room = Room::where('status','=','pa')->count();
            $response->data->advertisement = $advertisementCount;
            $response->data->user = Auth::user();

            return response()->json($response);


        }

    }
}
