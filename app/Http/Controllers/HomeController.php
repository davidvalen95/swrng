<?php

namespace App\Http\Controllers;

use App\Mail\TextEmail;
use App\Model\PageTitle;
use App\Model\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


/*
 * detail: property.html
 * new room: search-location.html
 * my room: about.html
 */


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public $data = [];
    public function __construct()
    {
//        $this->middleware('');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex(Request $request)
    {

        $post = (object) $request->all();
        $whereRoom = [['id','>',-1],['status','ap']];

//        debug($post);

        if(isset($post->search)){
            foreach ($post->search as $key=>$value){
                if($value){
                    $whereRoom[] = [$key,"like","%$value%"];

                }
            }
        }

//        debug($whereRoom);
        $rooms = Room::where($whereRoom)->paginate();

        $data = [];
        /** @var \App\Model\PageTitle $pageTitle */
        $pageTitle = PageTitle::where('page','=','home')->first();
        $data['title'] = $pageTitle->title;
        $data['description'] = $pageTitle->description;
        $data['rooms'] = $rooms;

        return view('home.home',$data);
    }

    /*
     * kapasitas orang per tipe ruangan
     *
     *
     *
     *
     */


}
