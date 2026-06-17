<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdClick extends Model
{
    protected $table = 'ad_clicks';

    protected $primaryKey = 'click_id';

    protected $fillable = [
        'ad_id',
        'buyer_id',
        'product_id',
        'is_reward_given'
    ];

    public function advertisement()
    {
        return $this->belongsTo(Advertisement::class, 'ad_id');
    }

    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }
}
