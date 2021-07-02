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
        $status = $this->status;

        if($status == 'active'){
            return 'Activo';
        }
        
        if($status == 'canceled'){
            return 'Cancelado';
        }        

    }

}
