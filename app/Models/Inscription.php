<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscription extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function meeting()
    {
        return $this->belongsTo(Meeting::class);
    }

    public function student()
    {
        return $this->belongsTo(User::class);
    }

    public function getState()
    {
        $state = $this->state;

        if($state == 'enrolled'){
            return 'Inscripto';
        }
        
        if($state == 'canceled'){
            return 'Cancelado';
        }

        if($state == 'attended'){
            return 'Asistido';
        }

        if($state == 'not_attended'){
            return 'Ausente';
        }

        

    }

}
