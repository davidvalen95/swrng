<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','HomeController@getIndex')->name('get.index');
Route::get('/ruang/{id}',"RoomController@getRoomDetail")->name('get.roomDetail');

Route::prefix('authentication')->group(function(){

    Route::post('register',"UserController@postRegister")->name('post.register');

    Route::post('login',"UserController@postLogin")->name('post.login');
    Route::get('verify',"UserController@getVerify")->name('get.verify');

    Route::post('request-reset','UserController@postRequestResetPassword')->name('post.requestReset');
    Route::get('reset-password', "UserController@getResetPassword")->name('get.resetPassword');
    Route::post('reset-password', "UserController@postResetPassword")->name('post.resetPassword');

});

Route::get('test',function(){
    echo "tst;";
});
Route::get('test-user-controller',"UserController@getTest")->name('get.UserControllerTest');

Route::prefix('member')->group(function(){
   Route::get('daftar-ruangan',"MemberController@getMyRoom")->name('get.myRoom')->middleware('auth')->middleware('auth');
   Route::get('edit-ruangan/{id}',"MemberController@getEditMyRoom")->name('get.editMyRoom')->middleware('auth');
   Route::post('tambah-ruangan',"MemberController@postAddRoom")->name('post.addRoom')->middleware('auth');
   Route::get('detail-ruangan/{id}',"MemberController@getMyRoomDetail")->name('get.myRoomDetail')->middleware('auth');

   Route::prefix('iklan')->group(function(){
       Route::get('daftar',"AdvertisementController@getMyAdvertisement")->name('get.myAdvertisement')->middleware('auth');
       Route::post('tambah','AdvertisementController@postAdvertisementForm')->name('post.advertisementForm')->middleware('auth');
       Route::get('detail/{id}','AdvertisementController@getAdvertisementDetail')->name('get.advertisementDetail')->middleware('auth');
       route::get('konfirmasi-pembayaran',"AdvertisementController@getAdvertisementPayment")->name('get.advertisementPayment');
       Route::post('konfirmasi-pembayaran',"AdvertisementController@postAdvertisementPayment")->name('post.advertisementPayment');
       Route::get('edit-iklan/{id}',"AdvertisementController@getEditAdvertisement")->name('get.editAdvertisement')->middleware('auth');
   });
});




Route::get('phpinfo',function(){
   phpinfo();
});


Route::post('/resend/verification',"UserController@postResendVerification")->name('post.resendVerification');





//
//# api to database
//
//Route::get('/city',function(){
//    $ch = curl_init();
//
//    // set url
//    curl_setopt($ch, CURLOPT_URL, "https://api.meetup.com/cities?country=id&offset=0&format=json&photo-host=public&page=200000&order=members&sig_id=245920397&sig=04b73ab0e7a2d8c23a032c6f0732ff86f2acdce3");
////    curl_setopt($ch, CURLOPT_URL, "https://google.com");
//
//    //return the transfer as a string
//    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//
//    // $output contains the output string
//    $output = curl_exec($ch);
//
//    // close curl resource to free up system resources
//    curl_close($ch);
//
////    debug(json_decode($output));
//
//    $output = str_replace("city","name",$output);
//    $output = strtolower($output);
//    $jsonObject = json_decode($output);
////    debug($jsonObject);
//    $tes = "";
//    $nameArray = [];
//    foreach ($jsonObject->results as $cityObject){
////        $tes .= "$cityObject->name " ;
//        $nameArray[] = ["name"=>$cityObject->name];
//    }
//
//    App\Model\City::insert($nameArray);
//
//
//    debug($tes);
////    return response($output,200,["Content-Type"=>"application/json"]);
//
////    return"ok";
//
//
//});
Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
