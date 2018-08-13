<?php

namespace App\Model;

use App\User;
use DateTime;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\Advertistment
 *
 * @property int $id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property int $user_id
 * @property string|null $imagePath
 * @property string|null $description
 * @property string|null $link
 * @property string|null $validThrough
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Advertistment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Advertistment whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Advertistment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Advertistment whereImagePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Advertistment whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Advertistment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Advertistment whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Advertistment whereValidThrough($value)
 * @mixin \Eloquent
 * @property string|null $status
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Advertistment whereStatus($value)
 * @property string|null $noRef
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Advertistment whereNoRef($value)
 * @property string|null $targetCity
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Advertistment whereTargetCity($value)
 * @property int|null $viewed
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Advertistment whereViewed($value)
 * @property string|null $validUntil
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Advertistment whereValidUntil($value)
 * @property int|null $select_advertisement_type_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Advertistment whereSelectAdvertisementTypeId($value)
 */
class Advertistment extends Model
{
    //
    public static function getTableName()
    {
        return with(new static)->getTable();
    }
    protected $table = 'advertistment';
    protected $fillable = ['imagePath', 'description', 'link', 'validThrough', 'status', 'noRef', 'targetCity'];



    public function getUser()
    {

        return $this->belongsTo('App\User', 'user_id');

    }

    public function getHistories()
    {
        return $this->hasMany('App\Model\AdvertistmentHistoryDescription', 'advertistment_id');
    }

    public function getPhoto()
    {
        return $this->hasOne('App\Model\Photo', 'advertistment_id');
    }

    public function getAdvertisementPath(User $user, $isPath = true)
    {

        $path = "{$user->getImagePath($isPath)}/advertisement/$this->id/";

        if ($isPath) {
            createDirIfNotExist($path);
            return "$path";
        } else {
            return $path;
        }
    }

    public function  getAdvertisementType(){
        return $this->belongsTo("App\Model\SelectAdvertisementType","select_advertisement_type_id",'id');
    }

    public function getLastUnpaidInvoice()
    {
        $test =   $this->getHistories
                    ->where('isPaid',false)
                    ->sortByDesc('created_at')
                    ->first();

//        debug($test);

        return $test;

    }

    public function getIsActive(){


        if($this->validUntil == null){
            return true;
        }
        $current = new DateTime('now');
        $current =  strtotime($current->format('Y-m-d'));
        $validUntil = strtotime($this->validUntil);
//
//                        debug($current->getTimestamp());
//                        debug(strtotime($model->validUntil));

        $isActive = $validUntil >= $current;

        return $isActive;

    }


    //# override status jadi lgsg update disini
    public function getStatusAttribute($value){
        if(!$this->getIsActive()){
            $this->status = 'exp';
            $this->save();
            $value = 'exp';
//            debug($value);
        }

        return $value;
    }
}
