<?php
    // use Auth;
    use Illuminate\Support\Facades\Session;
    use Illuminate\Pagination\LengthAwarePaginator as Pagination;;
    date_default_timezone_set('Asia/Jakarta');

function debug($var="hello"){
        die(var_dump($var));
    }


    function setSuccess($text){
        Session::flash('successNotification',"$text");


    }
    function setDanger($text){
        Session::flash('dangerNotification',"$text");

    }


    function getHighlight($needle,$haystack,$format=false){
        $needle = ucwords($needle);
        $haystack = ucwords($haystack);
        if($format){
            $needle = getSearchFormat($needle);
        }
        // debug($needle.$haystack);
        return str_replace($needle,"<span style='background-color:yellow;'><b>$needle</b></span>",$haystack);
    }



    function getUrlFormat($string){
        $string = preg_replace('/[^\w\s]/',"",$string);
        $string = preg_replace('/\s+/',"-",$string);
        $string = strtolower($string);
        // debug($string);
        return $string;
    }

    function getNameFormat($string){
        $string = str_replace("-"," ",$string);
        $string = preg_replace("/\s+/"," ",$string);
        $string = ucwords(strtolower($string));
        return $string;
    }

    function dateTimeToString($source, $format="D d-M"){
        date_default_timezone_set('Asia/Jakarta');
        $date = new DateTime($source);
        return $date->format($format); // 31.07.2012

    }
    function getDefaultDatetime($str=null,$format = "Y-m-d H:i:s"){
        date_default_timezone_set('Asia/Jakarta');
        if($str==NULL){
            return date($format,time());

        }else{
            return date($format, strtotime($str));

        }
    }

    function getSearchFormat($str){
        $str = strip_tags($str,'<br>'); //# kcuali br
        $str = str_replace('<br>',' ',$str); //# br jadi space
        // $str = preg_replace('/[^a-zA-Z\s]/','',$str); //# trims non word but not space
        // $str = preg_replace('/[\s+]/',' ',$str); //# trims spaces and non word
        $str = preg_replace('/[^a-zA-Z]/','',$str); //# trims everything
        $str = strtolower($str);
        // debug($str);
        return $str;
    }



    function pagination(Pagination $pagination){
		/*
		 * totalData	: data dari table
		 * fetch		: data per page
		 * threshold	: deretan pagination
		 * last			: pagination terakhir
		 *
		 * start	: terawal dari current
		 * end		: terjuh dari pagination
		 *
		 *
		 */

         $pagination->appends(Illuminate\Support\Facades\Input::except(['page']));

		$totalData	 		= $pagination->total();
		$fetch	 			= $pagination->perPage();
		$threshold			= 3;
		$last				= ceil($totalData / $fetch);
        $current            = $pagination->currentPage();
        // debug($pagination->url(1));
		$start				= ($current-$threshold >= $threshold?$current-$threshold:1);
		$end				= ($current+$threshold >= $last?$last:$current+$threshold);
		//debug(ceil($pagination / $fetch));
//		$list 				= "
//					<ul class='pagination pagination-sm no-margin pull-right'>
//						<li>
//                            <a href='".$pagination->url(1)."'>First</a>
//                        </li>
//		";
//		for($i=$start;$i<=$end;$i++){
//			$href    		= ($i==$current?"":"href='".$pagination->url($i)."'");
//			$active  		= ($i==$current?"background-color:#dcdcdc;":"");
//
//
//			$list	.= "<li>
//                            <a $href class='' style='$active'>$i</a>
//                        </li>";
//		}
//
//		$list				.= "<li>
//                                    <a href='".$pagination->url($pagination->lastPage())."'>Last</a>
//                                </li>
//                                </ul>";


        $list ="
             <a href='{$pagination->previousPageUrl()}' class='prev'>Previous</a>
                        <a href='{$pagination->nextPageUrl()}' class='next'>Next</a>
        ";


		return $list;
	}


    function saveEvent($message, $user = true){
        $event = new App\Model\Event();

        if($user){
            $user =  Auth::user();;
        }
        $event->detail = $message;
        // debug(getDefaultDatetime());
        $event->created_at = getDefaultDatetime();

        $event->getUser()->associate($user);
        $event->save();
    }

    function hexToRgb($color)
    {
        $hex = $color;
        $hex = list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");
        return $hex;
//        echo "$hex -> $r $g $b";
    }

    function createDirIfNotExist($path){
        if(!is_dir($path)){
//            debug($path);

            mkdir($path,0777, true);
        }

    }

    function publicAsset($target){

        return asset("public/$target");
    }

    function savePhoto($photoRequest, $path, $width=300):App\Model\Photo {
        $name = str_random(8);
        $nameThumbnail = $name."-small".".".$photoRequest->extension();
        $name .= ".".$photoRequest->extension();
        $img = Image::make($photoRequest);
        $img->resize($width*2, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save($path.$name);
        $img->resize($width, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save($path.$nameThumbnail);

        $photo = new App\Model\Photo();
        $photo->path = $path;
        $photo->nameLg = $name;
        $photo->nameSm = $nameThumbnail;


        return $photo;

    }

    function getSemicolonFormat($target){
        if(is_array($target)){
            $value = "";
            foreach ($target as $current){
                $value .= "$current;";
            }
            return $value;
        }else{
            return $target;
        }
    }

    function getReadableSemicolonFormat($target){
        $target = explode(';',$target);
        $target = join(' ', $target);
        return $target;
    }

    function getReadableStatus($status){
        switch(strtolower($status)){
            case "pe":
            case "pa":
                return "<span style='color: tomato;'> <b>Belum disetujui</b> </span>";
            case "ap":
                return "<span style='color: green;'><b> Telah disetujui </b></span>";
            case "exp":
                return "<span style='color: black;'> <b>Expired </b></span>";
            case "re":
                return "<span style='color: #b59e0c;'> <b>Ditolak (rejected) </b></span>";

            default:
                return "Unregistered status";

        }


    }

    function getAdvertisement($city=null){

        $advertisements = \App\Model\Advertistment::where('validUntil', '>=', getDefaultDatetime(null,'Y-m-d'));

        if($city){
            $advertisements->where('targetCity', $city);
        }

        $advertisements = $advertisements->orderBy('viewed','desc')->take(5)->get();
        foreach ($advertisements as $advertisement){
            $advertisement->viewed ++;
//            debug($advertisement->getPhoto());

            $advertisement->save();
        }
        return $advertisements;

    }

    function getDefaultResponse(){
        $response = (object) [];
        $response->message = "";
        $response->isSuccess = true;
        $response->data = (object)[];

        return $response;
    }
 ?>
