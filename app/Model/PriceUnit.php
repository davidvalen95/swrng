<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\PriceUnit
 *
 * @property int $id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\PriceUnit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\PriceUnit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\PriceUnit whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\PriceUnit whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PriceUnit extends Model
{
    //
    protected $table = "price_unit";
    protected $fillable = ["name"];
    public static function getTableName()
    {
        return with(new static)->getTable();
    }
}
