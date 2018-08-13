<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\AdvertistmentPeriod
 *
 * @property int $id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string $name
 * @property string $value
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\AdvertistmentPeriod whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\AdvertistmentPeriod whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\AdvertistmentPeriod whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\AdvertistmentPeriod whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\AdvertistmentPeriod whereValue($value)
 * @mixin \Eloquent
 * @property string $price
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\AdvertistmentPeriod wherePrice($value)
 */
class AdvertistmentPeriod extends Model
{
    //

    protected $table = "advertistment_period";
    protected $fillable = ["name","value","price"];

    public static function getTableName()
    {
        return with(new static)->getTable();
    }
    public function setDefaultPreference(){
        $this->price = number_format($this->price);
    }
}
