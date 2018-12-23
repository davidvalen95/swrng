<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\SelectAdvertisementType
 *
 * @property int $id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\SelectAdvertisementType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\SelectAdvertisementType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\SelectAdvertisementType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\SelectAdvertisementType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SelectAdvertisementType extends Model
{
    //

    protected $table = "select_advertisement_type";



}
