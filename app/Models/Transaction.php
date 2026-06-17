<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions';

    protected $fillable = [
        'userid',
        'transactionid',
        'amount',
        'currency',
        'credited',
        'debited',
        'remark',
        'isPaid',
        'postedon',
    ];

    public $timestamps = false; // because table uses postedon, not created_at

    protected $casts = [
        'amount'   => 'float',
        'credited' => 'int',
        'debited'  => 'int',
        'isPaid'   => 'boolean',
        'postedon' => 'datetime',
    ];

    /**
     * Relationship: Transaction belongs to User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'userid');
    }
}
