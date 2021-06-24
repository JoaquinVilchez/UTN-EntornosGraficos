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

    public function canceledMeetings(){
        return $this->hasMany(CanceledMeetings::class);

    }

    public function getState()
    {
        $state = $this->state;

        if($state == 'canceled'){
            return 'Cancelado';
        }
        
        if($state == 'active'){
            return 'Activo';
        }        

    }

    public function getType(){
        $type = $this->type;

        if($type == 'face-to-face') return 'Presencial';

        if($type == 'virtual') return 'Virtual';
    }






}
