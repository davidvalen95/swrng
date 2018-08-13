<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\Facility
 *
 * @property int $id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Facility whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Facility whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Facility whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Facility whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Facility extends Model
{
    //
    protected $table = "facility";
    protected $fillable = ["name"];
    public static function getTableName()
    {
        return with(new static)->getTable();
    }
}
