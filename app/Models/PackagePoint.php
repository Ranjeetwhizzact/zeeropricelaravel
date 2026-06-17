<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackagePoint extends Model

    //
{
    protected $table = 'pointspackage';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'packagename',
        'points',
        'currency',
        'cost',
        'istatus'
    ];

    protected $casts = [
        'points' => 'integer',
        'cost' => 'decimal:2',
        'istatus' => 'integer'
    ];

    // Scope for active packages
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    // Get formatted cost with currency
    public function getFormattedCostAttribute()
    {
        return $this->currency . ' ' . number_format($this->cost, 2);
    }

    // Get status badge class
    public function getStatusBadgeAttribute()
    {
        return $this->status == 1 
            ? '<span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Active</span>'
            : '<span class="px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Inactive</span>';
    }

    
}
