<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $primaryKey = 'catid'; // 👈 IMPORTANT

    public $timestamps = false; // 👈 if no created_at

    protected $fillable = [
        'catname',
        'istatus',
    ];

    public function subcategories()
    {
        return $this->hasMany(Subcategory::class,'catid','catid');
    }
}