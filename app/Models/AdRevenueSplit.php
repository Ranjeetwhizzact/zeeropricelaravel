<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdRevenueSplit extends Model
{
    protected $table = 'ad_revenue_split';

    protected $fillable = [
        'click_id',
        'total_amount',
        'buyer_reward',
        'product_reduction',
        'ad_product_reduction',
        'platform_earning'
    ];

    public function click()
    {
        return $this->belongsTo(AdClick::class, 'click_id');
    }
}
