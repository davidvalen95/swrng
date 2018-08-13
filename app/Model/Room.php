<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Room
 *
 * @property 
 * @package App\Model
 * @property int $id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $city
 * @property string|null $name
 * @property int|null $capacity
 * @property int|null $area
 * @property string|null $areaUnit
 * @property string|null $facility
 * @property string|null $priceHalfDay
 * @property string|null $priceFullDay
 * @property string|null $locationMap
 * @property string $address
 * @property string $status
 * @property string|null $description
 * @property string|null $function
 * @property string|null $buildingName
 * @property string|null $capacityType
 * @property string|null $roomName
 * @property string|null $caterings
 * @property string|null $providerTelephone
 * @property int|null $totalRoom
 * @property int|null $mainPrice
 * @property int|null $parking
 * @property int $user_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Room whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Room whereArea($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Room whereAreaUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Room whereBuildingName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Room whereCapacity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Room whereCapacityType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Room whereCaterings($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Room whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Room whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Room whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Room whereFacility($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Room whereFunction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Room whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Room whereLocationMap($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Room whereMainPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Room whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Room whereParking($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Room wherePriceFullDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Room wherePriceHalfDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Room whereProviderTelephone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Room whereRoomName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Room whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Room whereTotalRoom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Room whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Room whereUserId($value)
 * @mixin \Eloquent
 * @property int|null $capacityClass
 * @property int|null $capacityUShape
 * @property int|null $capacityTheatre
 * @property string|null $roomFunction
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Room whereCapacityClass($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Room whereCapacityTheatre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Room whereCapacityUShape($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Room whereRoomFunction($value)
 * @property string|null $mainPriceUnit
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Room whereMainPriceUnit($value)
 * @property string|null $statusReason
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Room whereStatusReason($value)
 */
class Room extends Model
{
    //
    protected $table = "room";
    protected $fillable = ["city",
        "room",
        "capacity",
        "area",
        "facility",
        "locationMap",
        "address",
        "status",
        "description",
        "buildingName",
        "capacityType",
        "roomName",
        "totalRoom",
        "caterings",
        "mainPrice",
        "areaUnit",
        "roomFunction",
        "capacityClass",
        "capacityUShape",
        "capacityTheatre",
        "providerTelephone",
        "mainPriceUnit",
        "statusReason",
    ];
    protected $dates = ['created_at'];

    private $isPreferenceSet = false;
    protected $perPage = 30;


    public function getPrices(){
        return $this->hasMany("App\Model\Prices");
    }

    public function getUser(){
        return $this->belongsTo("App\User","user_id");
    }

    public function getBanners(){
        return $this->hasMany("App\Model\Banner","banner_room", "room_id","banner_id");
    }

    public function getPhotos(){
        return $this->hasMany("App\Model\Photo", "room_id");
    }

    public function getImagePath(User $user, $isPath = true){

        $path = "{$user->getImagePath($isPath)}/room/$this->id/";

        if($isPath){
            createDirIfNotExist($path);
            return "$path";
        }else{
            return $path;
        }
    }

    public function setDefaultPreference(){

        if($this->isPreferenceSet){
            return;
        }
        foreach($this->getAttributes() as $key=>$value){
            if(is_string($value)){
                $this->$key = str_replace(";",' - ',"$value");

            }
        }

        $this->city = ucwords($this->city);
        try{
            $this->mainPrice =  number_format($this->mainPrice);

        }catch(Exception $e){

        }
        $this->buildingName = ucwords($this->buildingName);
        $this->address = ucwords($this->address);
        $this->facility = ucwords($this->facility);
        $this->caterings = ucwords($this->caterings);
        $this->isPreferenceSet = true;
    }
    public static function getTableName()
    {
        return with(new static)->getTable();
    }
}
