<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function inscription()
    {
        return $this->HasMany(Inscription::class);
    }

    public function meeting()
    {
        return $this->hasMany(Meeting::class);
    }

    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }

    public function getFullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getType()
    {
        if ($this->type == 'student') {
            return 'Estudiante';
        } elseif ($this->type == 'teacher') {
            return 'Profesor';
        } elseif ($this->type == 'admin') {
            return 'Administrador';
        }
    }
}
