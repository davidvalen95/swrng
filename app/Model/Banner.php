<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\Banner
 *
 * @property int $id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string $applyDate
 * @property string|null $adminResponseDate
 * @property int $dayDuration
 * @property string|null $status
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Banner whereAdminResponseDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Banner whereApplyDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Banner whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Banner whereDayDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Banner whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Banner whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Banner whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Banner extends Model
{
    //

    protected  $table="banner";
    protected $fillable = ["name"];
    public static function getTableName()
    {
        return with(new static)->getTable();
    }
    public function getRooms(){
        return $this->belongsToMany("App\Model\Room","banner_room","banner_id","room_id");
    }
}
