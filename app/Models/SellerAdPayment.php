<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SellerAdPayment extends Model
{
    protected $table = 'seller_ad_payments';

    protected $primaryKey = 'payment_id';

    protected $fillable = [
        'seller_id',
        'ad_id',
        'amount',
        'payment_status'
    ];

    public function advertisement()
    {
        return $this->belongsTo(Advertisement::class, 'ad_id');
    }
}
