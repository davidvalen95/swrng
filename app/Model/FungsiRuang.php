<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\FungsiRuang
 *
 * @property int $id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\FungsiRuang whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\FungsiRuang whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\FungsiRuang whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\FungsiRuang whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class FungsiRuang extends Model
{
    //

    protected $table = "fungsi_ruang";
    protected $fillable = ["name"];
    public static function getTableName()
    {
        return with(new static)->getTable();
    }
}
