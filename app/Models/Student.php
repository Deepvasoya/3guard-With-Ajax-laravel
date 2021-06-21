<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Authenticatable
{
    use SoftDeletes, Notifiable;

    protected $guard = 'student';

    protected $fillable = [
        'name', 'email', 'enrollno', 'standard', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function result()
    {
        return $this->hasOne(Result::class);
    }
}
