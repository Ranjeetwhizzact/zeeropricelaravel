<?php
// app/Models/User.php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'phone', 'password', 'role', 'points'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'points' => 'integer',
    ];

    // Check if user is admin
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    // Check if user is director
    public function isDirector()
    {
        return $this->role === 'director';
    }

    // Check if user is executive
    public function isExecutive()
    {
        return $this->role === 'executive';
    }

    // Check if user is subexecutive
    public function isSubExecutive()
    {
        return $this->role === 'subexecutive';
    }
}