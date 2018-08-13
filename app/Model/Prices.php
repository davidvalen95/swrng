<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\Prices
 *
 * @property int $id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property int|null $price
 * @property string|null $unit
 * @property int $room_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Prices whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Prices whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Prices wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Prices whereRoomId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Prices whereUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Prices whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Prices extends Model
{
    //

    protected $table = "prices";
    protected $fillable = ["price","unit"];


    public function getRoom(){
       return $this->belongsTo("App\Model\Room","room_id");
    }
    public static function getTableName()
    {
        return with(new static)->getTable();
    }
}
