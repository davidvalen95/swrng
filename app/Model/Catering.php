<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\Catering
 *
 * @property int $id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Catering whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Catering whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Catering whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Catering whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Catering extends Model
{
    //
    protected $table = "catering";
    protected $fillable = ["name"];
    public static function getTableName()
    {
        return with(new static)->getTable();
    }
}
