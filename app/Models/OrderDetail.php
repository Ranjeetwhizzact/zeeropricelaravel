<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $table = 'orders_detail';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'orderid',
        'sellerid',
        'userid',
        'isFree',
        'pid',
        'title',
        'qty',
        'mrp',
        'minprice',
        'collectedprice',
        'customercost',
        'otp',
        'isCancelled',
        'cancelledOn',
        'returndays',
        'isDelivered',
        'postedon'
    ];
}