<?php

use App\Models\Subject;



if(!function_exists('get_subjects_for_level')){
    function get_subjects_for_level($level){
        
        $subjects =  Subject::all()->where('level',$level);
        return $subjects;            
    
    }
        
}

function getSpanishWeekDays()
{
    return [
        1 => 'Lunes',
        2 => 'Martes',
        3 => 'Miércoles',
        4 => 'Jueves',
        5 => 'Viernes',
        6 => 'Sábado',
        7 => 'Domingo'
    ];
}