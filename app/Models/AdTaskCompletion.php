<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdTaskCompletion extends Model
{
    protected $table = 'ad_task_completions';

    protected $fillable = [
        'task_id',
        'ad_id',
        'user_id'
    ];

    public function task()
    {
        return $this->belongsTo(AdTask::class, 'task_id');
    }
}
