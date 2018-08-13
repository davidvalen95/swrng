<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\AdvertistmentPayment
 *
 * @property int $id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $invoice
 * @property string|null $path
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\AdvertistmentPayment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\AdvertistmentPayment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\AdvertistmentPayment whereInvoice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\AdvertistmentPayment wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\AdvertistmentPayment whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AdvertistmentPayment extends Model
{
    //

    protected $table = "advertistment_payment";
    protected $fillable = ["path","invoice"];



    public function getPhoto(){
        return $this->hasOne("App\Model\Photo", "advertistment_payment_id");
    }

    public function getPaymentImagePath(User $user){

        $userPath = $user->getImagePath(true);
        $paymentPath = "{$userPath}/payment/{$this->id}/";

        createDirIfNotExist($paymentPath);

        return $paymentPath;
    }
    public static function getTableName()
    {
        return with(new static)->getTable();
    }
}
