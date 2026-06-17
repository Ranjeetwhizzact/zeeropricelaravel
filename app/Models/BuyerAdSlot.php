<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BuyerAdSlot extends Model
{
    protected $table = 'buyer_ad_slots';

    protected $fillable = [
        'buyer_id',
        'ad_id',
        'status'
    ];

    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    public function advertisement()
    {
        return $this->belongsTo(Advertisement::class, 'ad_id');
    }
}
