<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $table = 'subcategories';

    protected $primaryKey = 'subcatid'; 
    public $timestamps = false;

    protected $fillable = [
        'catid',
        'subcatname',
        'istatus',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class,'catid','catid');
    }
}