<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

if(IS_SERVER){
    header("Access-Control-Allow-Origin: https://sewaruang.id");

}else{
    header("Access-Control-Allow-Origin: http://localhost:4200");

}

header("Access-Control-Allow-Credentials: true");

//header("Access-Control-Allow-Methods: *");
header("Access-Control-Allow-Headers: Content-Type, X-Auth-Token, Origin, authorization, Authorization, X-Csrf-Token");

Route::middleware(['auth:api','cors'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/list/city',function(Request $request){
   $city = \App\Model\City::all();
   return response()->json($city);

});

Route::match(['get', 'post'],'login-admin','UserController@postLoginAdmin');

Route::group(['middleware'=>'auth:api,web'],function(){
    Route::match(['get', 'post'],'database/select-list',"DatabaseConfiguration@getSelectList");
    Route::match(['get','post'], 'database/page-title','DatabaseConfiguration@anyPageTitle');
    Route::match(['get', 'post'],'module/room',"RoomController@anyRoomModule");
    Route::match(['get', 'post'],'module/advertisement',"AdvertisementController@anyAdvertisementModule");
    Route::match(['get','post'], 'bootstrap/notification','BootstrapController@anyNotification');

});