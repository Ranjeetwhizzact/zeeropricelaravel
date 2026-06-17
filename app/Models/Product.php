<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $table = "products";
    protected $primaryKey = "pid";

    protected $fillable = [
        'sellerid',
        'catid',
        'subcatid',
        'pic1',
        'pic2',
        'pic3',
        'pic4',
        'title',
        'description',
        'currency',
        'mrp',
        'minprice',
        'reducedprice',
        'collectedprice',
        'returndays',
        'postedon',
        'ip',
        'isupdated',
        'isupdateid',
        'isactive',
        'tilldate',
        'issold',
        'isstatus'
    ];

    // 🔗 Relationships
    public function category()
    {
        return $this->belongsTo(Category::class, 'catid', 'id');
    }

    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class, 'subcatid', 'id');
    }

    public function advertisements()
    {
        return $this->hasMany(Advertisement::class, 'product_id');
    }
}
