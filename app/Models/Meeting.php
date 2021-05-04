<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function subject()
    {
        return $this->hasOne(Subject::class);
    }

    public function teacher()
    {
        return $this->hasOne(User::class);
    }

    public function inscription()
    {
        return $this->hasMany(Inscription::class);
    }


    // $consulta = Meeting::find(1);

    // $consulta->user;





}
