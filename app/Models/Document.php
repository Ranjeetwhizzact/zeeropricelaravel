<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{
    //
    use SoftDeletes;

    protected $table = 'documents';

    protected $fillable = [
        'user_id',
        'doctype',
        'doc_path',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo(UsersProfile::class, 'user_id', 'id');
    }
}
