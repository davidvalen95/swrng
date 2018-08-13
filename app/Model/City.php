<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\City
 *
 * @property int $id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\City whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\City whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\City whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\City whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class City extends Model
{
    //
    protected $table = "city";
    protected $fillable = ["name"];
    public static function getTableName()
    {
        return with(new static)->getTable();
    }
}
