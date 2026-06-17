<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pointspackage extends Model
{
    //
     protected $table = 'pointspackage';

    protected $fillable = [
        'packagename',
        'points',
        'currency',
        'cost',
        'isstatus',
    ];
}
