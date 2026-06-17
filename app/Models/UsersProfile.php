<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersProfile extends Model
{
    //
     protected $table = 'usersprofile';

    protected $fillable = [
        'user_id',
        'full_name',
        'profile_image',
        'dob',
        'number',
        'address_type',
    ];

    public function addresses()
    {
        return $this->hasMany(Address::class, 'user_id', 'id');
    }

    public function documents()
    {
        return $this->hasMany(Document::class, 'user_id', 'id');
    }
}
