<?php

namespace App\Http\Controllers;

use App\Mail\TextEmail;
use App\User;
use CForm;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    //






    protected $redirectTo = '/';

    public function __construct(Request $request){

        if(!$request->is('api/*')){
            $this->middleware("guest");

        }
    }


    public function postRegister(Request $request){
//        debug($request->all());
        $post = (object)$request->all();
        $request->validate([

            "name"=>"required",
            "email"=>"required|email|unique:users,email",
            "password"=>"required|confirmed|min:6",
            "city"=>"required",
            "telephone"=>"required|numeric",



        ]);

//        User::insert($post);

        $post->password = Hash::make($post->password);
        $post->isVerified = false;
        $post->verifyKey = str_random(32);
        $user = new User((array)$post);
        $user->save();
        $user->setDefaultPreference();
//        $isAuth = Auth::attempt(["email"=>$user->email,"password"=>Hash::make($user->password)]);

        $eol = PHP_EOL;
        Mail::to($user->email)->queue(new TextEmail("Halo $user->name{$eol}Please click here to verify your email{$eol}".
            route('get.verify',
                [
                    "email"=>$user->email,
                    "verifyKey"=>$user->verifyKey,
                ]),"Verifikasi Email"));


        setSuccess("Register Succeed. We sent you verification email. Please verify your email.");


        return redirect()->back();
    }


    public function postLoginAdmin(Request $request){
        $post = (object) $request->all();

        $isAuth = Auth::attempt(["email"=>$post->email,"password"=>($post->password),'isAdmin'=>true]);
        $response= (object)[];
        $response->isSuccess = false;
        $response->message = "Wrong username or password";

        if($isAuth){
            $user = Auth::user();
            $response->data = (object)[];
            $response->isSuccess = true;
            $response->message = "Logged in";
            $response->data->user = $user;
//            $response->data->token = $user->createToken('myToken')->accessToken;
            return response()->json($response);
        }else{
            return response()->json($response);

        }
    }

    public function postLogin(Request $request){
        $post = (object) $request->all();

        $isAuth =         Auth::attempt(["email"=>$post->email,"password"=>($post->password)]);




        if($request->is('api/*')){

            if($isAuth){
                $user = Auth::user();
                $response= (object)[];
                $response->data = (object)[];
                $response->success = true;

                $response->message = "Logged in";
                $response->data->user = $user;
                $response->data->token = $user->createToken('myToken')->accessToken;
                return response()->json($response);
            }else{
                return response()->json(['message'=>'Not authenticated'],401);

            }

        }


        if($isAuth){
//            $user = Auth::user();
//            $user->sendPasswordResetNotification("ssdf");
            $user = Auth::user();
            $user->setDefaultPreference();
            if(!$user->isVerified){
                Session::flash('dangerNotification',"Email not verified, please verify your email {$user->email}");
                Auth::logout();
            }else{
                Session::flash('successNotification',"Welcome back {$user->name}");
            }
        }else{
            Session::flash('dangerNotification',"Wrong email or password");

        }

        return redirect()->back();



    }




    public function getVerify(Request $request){
        $input = (object) $request->all();

        $user = User::where('email','=',$input->email)->first();
        if(!$user){
            return redirect('');
        }
        $user->setDefaultPreference();

//        debug(route('get.verify',
//            [
//                "email"=>$user->email,
//                "verifyKey"=>$user->verifyKey
//            ]));
        if($user->verifyKey == $input->verifyKey){
            $user->isVerified = true;
        }
        $user->save();
        Auth::login($user);
        setSuccess("Email verified, welcome back {$user->name}");
        return redirect('');


    }

    public function getTest(){

        return "userController";
    }



    public function postRequestResetPassword(Request $request){


//        debug($_ENV);
        $post = (object)$request->all();
//        debug($post);
        $user = User::where('email',$post->email)->first();

        if($user){
            $user->reset = str_random(16);
            $user->save();

            $url = route('get.resetPassword',['reset'=>$user->reset, "email"=>$user->email]);
//            $url = "";
            $textEmail = new TextEmail("Klik link di bawah ini untuk merubah passowrd ".PHP_EOL." {$url} ", "Reset Password");
            Mail::to($user->email)->send($textEmail);

            setSuccess("Kode reset password telah dikirim ke email anda. Silahkan reset password anda melalui link pada email");
        }else{
            setDanger("Email tidak ditemukan");
        }

        return redirect('');



    }

    public function getResetPassword(Request $request){


        $post = (object) $request->all();

        if(!isset($post->email) || !isset($post->reset)){
            setDanger('Data tidak lengkap');
            return redirect('');
        }

        $user = User::where('email',$post->email)->where('reset',$post->reset)->first();

        if($user){

            $password = new CForm("Password","password","password");
            $password->isRequired = true;
            $confirmFassword = new CForm("Confirm Password","password_confirmation","password");
            $confirmFassword->isRequired = true;
            $email = new CForm("","email","text");
            $email->value = $user->email;
            $email->isHidden = true;
            $reset = new CForm("","reset","text");
            $reset->value = $user->reset;
            $reset->isHidden = true;


            $data = [];
            $data['forms'] = [$password,$confirmFassword,$email,$reset];
            $data['user'] = $user;
            
            return view('user.resetPassword',$data);
        }else{

            setDanger("kode email dan reset password tidak ditemukan");
            return redirect('');
        }
    }

    public function postResetPassword(Request $request){
//        $this->middleware('auth');
        $post = (object)$request;
        $this->validate($request,[
           "password"=>"required|confirmed",
            "email"=>"required",
        ]);

        $user = User::whereEmail($post->email)->where('reset',$post->reset)->first();
        $user->password = Hash::make($post->password);
        $user->reset = null;
        $user->save();



        setSuccess("Password untuk $user->name telah di reset. Silahkan login");
        return redirect('');





    }
}
