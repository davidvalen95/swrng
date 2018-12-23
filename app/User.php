<?php

namespace App;

use App\Mail\TextEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Mail;
use Laravel\Passport\HasApiTokens;

/**
 * App\User
 *
 * @property int $id
 * @property string $email
 * @property string $password
 * @property string|null $remember_token
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $city
 * @property string|null $telephone
 * @property int|null $isVerified
 * @property string|null $verifyKey
 * @property string|null $name
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereIsVerified($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereTelephone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereVerifyKey($value)
 * @mixin \Eloquent
 * @property string|null $reset
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereReset($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Client[] $clients
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Token[] $tokens
 * @property int $isAdmin
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereIsAdmin($value)
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    protected $fillable = [
        'name', 'email', 'password',"city","telephone","isVerified","verifyKey", "reset",
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getRooms(){
        return $this->hasMany("App\Model\Room","user_id");
    }

    public function setDefaultPreference(){

        $this->name = getNameFormat($this->name);
        return $this;
    }

    public function getAdvertistments(){
        return $this->hasMany('App\Model\Advertistment','user_id');
    }

    public function getImagePath($isPath = true){
//        $publicPath = $isPath ? "public/" : "";
        $path =  "image/member/$this->id";

        if($isPath){
            createDirIfNotExist($path);
            return ("public/".$path);
        }else{
            return publicAsset($path);
        }

    }


    public function sendEmail($subject, $content){

        Mail::to($this->email)->queue(new TextEmail($content ,$subject));




    }
}
