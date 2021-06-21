<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends Authenticatable
{
    use SoftDeletes, Notifiable;

    protected $guard = 'teacher';

    protected $fillable = [
        'name', 'email', 'subject', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
