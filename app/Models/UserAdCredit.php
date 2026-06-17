<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAdCredit extends Model
{
    protected $fillable = [
        'user_id',
        'total_credits',
        'used_credits'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Helper
    public function remaining()
    {
        return $this->total_credits - $this->used_credits;
    }
}
