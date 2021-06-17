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
        return $this->belongsTo(Subject::class);
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'profesor_id');
    }

    public function inscriptions()
    {
        return $this->hasMany(Inscription::class);
    }


    // $consulta = Meeting::find(1);

    // $consulta->user;





}
