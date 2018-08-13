<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\Photo
 *
 * @property int $id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string $path
 * @property string|null $description
 * @property int $isMain
 * @property string|null $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Photo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Photo whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Photo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Photo whereIsMain($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Photo whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Photo wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Photo whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $nameLg
 * @property string|null $nameSm
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Photo whereNameLg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Photo whereNameSm($value)
 * @property int $room_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Photo whereRoomId($value)
 * @property int|null $advertistment_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Photo whereAdvertistmentId($value)
 * @property int|null $advertistment_payment_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Photo whereAdvertistmentPaymentId($value)
 */
class Photo extends Model
{
    //

    protected $table = "photo";
    protected $fillable = ["path","description","isMain"];

    public function getRoom(){

       return  $this->belongsTo('App\Model\Room',"room_id");
    }

    public function getSmall(){
        return asset("{$this->path}$this->nameSm");
    }

    public function getLarge(){
//        return "{$this->path}$this->nameLg";
        return asset("{$this->path}$this->nameLg");


    }

    public function getAdvertisement(){
        return $this->belongsTo("App\Model\Advertistment","advertistment_id");
    }

    public function getAdvertistmentPayment(){
        return $this->belongsTo("App\Model\AdvertistmentPayment","advertistment_payment_id");
    }
    public static function getTableName()
    {
        return with(new static)->getTable();
    }
}
