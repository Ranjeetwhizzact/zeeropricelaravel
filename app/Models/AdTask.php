<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdTask extends Model
{
    protected $table = 'ad_tasks';

    protected $primaryKey = 'task_id';

    protected $fillable = [
        'ad_id',
        'user_id',
        'task_type',
        'task_details',
        'comment_text',
        'reward'
    ];

    public function advertisement()
    {
        return $this->belongsTo(Advertisement::class, 'ad_id');
    }

    public function completions()
    {
        return $this->hasMany(AdTaskCompletion::class, 'task_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
