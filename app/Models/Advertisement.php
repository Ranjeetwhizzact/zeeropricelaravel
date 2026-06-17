<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    protected $table = 'advertisements';

    protected $primaryKey = 'ad_id';

    protected $fillable = [
        'seller_id',
        'product_id',
        'title',
        'description',
        'start_date',
        'end_date',
        'status',
        'media_type',
        'media_url'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function clicks()
    {
        return $this->hasMany(AdClick::class, 'ad_id');
    }

    public function payments()
    {
        return $this->hasMany(SellerAdPayment::class, 'ad_id');
    }

    public function tasks()
    {
        return $this->hasMany(AdTask::class, 'ad_id');
    }
}
