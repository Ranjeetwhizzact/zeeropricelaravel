<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    //
       protected $table = 'address';

    protected $primaryKey = 'address_id';

    protected $fillable = [
        'user_id',
        'house_no',
        'street',
        'area',
        'city',
        'district',
        'state',
        'pincode',
        'country',
    ];

    public function user()
    {
        return $this->belongsTo(UsersProfile::class, 'user_id', 'id');
    }
}
