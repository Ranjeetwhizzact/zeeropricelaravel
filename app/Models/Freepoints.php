<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Freepoints extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'userid',
        'points',
        'postedon',
    ];
     protected $table = 'freepoints';
}
