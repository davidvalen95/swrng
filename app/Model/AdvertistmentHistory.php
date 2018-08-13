<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\AdvertistmentHistory
 *
 * @property int $id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property int $advertistment_id
 * @property string|null $applyDate
 * @property string|null $confirmedDate
 * @property int|null $duration
 * @property string|null $invoiceNumber
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\AdvertistmentHistory whereAdvertistmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\AdvertistmentHistory whereApplyDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\AdvertistmentHistory whereConfirmedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\AdvertistmentHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\AdvertistmentHistory whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\AdvertistmentHistory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\AdvertistmentHistory whereInvoiceNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\AdvertistmentHistory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AdvertistmentHistory extends Model
{
    //

    protected $table = 'advertistment_history';
    protected $fillable = ['applyDate', 'confirmedDate','duration','invoiceNumber'];
    public static function getTableName()
    {
        return with(new static)->getTable();
    }

    protected function getAdvertistment(){
        return $this->belongsTo('App\Model\Advertistment','advertistment_id');
    }
}
