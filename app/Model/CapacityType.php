<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\CapacityType
 *
 * @property int $id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\CapacityType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\CapacityType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\CapacityType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\CapacityType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CapacityType extends Model
{
    //
    protected $table = "capacity_type";
    protected $fillable = ["name"];
    public static function getTableName()
    {
        return with(new static)->getTable();
    }

}
