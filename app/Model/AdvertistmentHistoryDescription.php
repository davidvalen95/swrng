<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\AdvertistmentHistoryDescription
 *
 * @property int $id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property int|null $advertistment_id
 * @property string $description
 * @property string $status
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\AdvertistmentHistoryDescription whereAdvertistmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\AdvertistmentHistoryDescription whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\AdvertistmentHistoryDescription whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\AdvertistmentHistoryDescription whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\AdvertistmentHistoryDescription whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\AdvertistmentHistoryDescription whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $invoice
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\AdvertistmentHistoryDescription whereInvoice($value)
 * @property string $price
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\AdvertistmentHistoryDescription wherePrice($value)
 * @property int $isPaid
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\AdvertistmentHistoryDescription whereIsPaid($value)
 * @property int|null $duration
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\AdvertistmentHistoryDescription whereDuration($value)
 */
class AdvertistmentHistoryDescription extends Model
{
    //

    protected $fillable = ["description","status","invoice"];

    protected $table = "advertistment_history_description";

    public function getAdvertisement(){
        return $this->belongsTo("App\Model\Advertistment","advertistment_id");
    }
    public static function getTableName()
    {
        return with(new static)->getTable();
    }

    public function setDefaultPreference(){

        $this->price = "Rp. " . number_format($this->price);



    }


    public function getPayment(){
        if($this->invoice){
            return AdvertistmentPayment::where('invoice','=',$this->invoice)->get();
        }
        return null;
    }
}
