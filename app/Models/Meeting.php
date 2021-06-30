<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
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
        return $this->belongsTo(User::class);
    }

    public function inscriptions()
    {
        return $this->hasMany(Inscription::class);
    }

    public function canceledMeetings()
    {
        return $this->hasMany(CanceledMeetings::class);
    }

    public function getState()
    {
        $state = $this->status;

        if ($state == 'canceled') {
            return '<span class="badge badge-danger">Cancelado</span>';
        }

        if ($state == 'active') {
            return '<span class="badge badge-success">Activo</span>';
        }
    }

    public function getType()
    {
        $type = $this->type;

        if ($type == 'face-to-face') return 'Presencial';

        if ($type == 'virtual') return 'Virtual';
    }

    public function getDayAndHour()
    {
        $weekDays = [
            1 => 'Lunes',
            2 => 'Martes',
            3 => 'Miércoles',
            4 => 'Jueves',
            5 => 'Viernes',
            6 => 'Sábado',
            0 => 'Domingo'
        ];

        return $weekDays[$this->day] . ' a las ' . $this->hour . 'hs';
    }

    public function getExcelDayAndHour()
    {
        $weekDays = getSpanishWeekDays();
        return $weekDays[$this->day] . ' - ' . $this->hour;
    }


    public function next_meetings($cant)
    {

        $dates = new Collection();
        $dayName = getDayName($this->day);   
        $date = Carbon::now()->next($dayName)->setTimeFromTimeString($this->hour);
        
        for($i=1; $i<=$cant; $i++){

            $dates->push($date->copy());          
            $date->addWeek(1);
        } 

        return $dates;

    }

    public function isActiveForDate($date)
    {
        $canceledMeetings = CanceledMeetings::all()->where('meeting_id', $this->id)->where('datetime', $date->format('Y-m-d H:i:s'));

        if(! $canceledMeetings->first()) //not canceled meeting
        {
            return true;   
        }   

        else return false;


    }
}
