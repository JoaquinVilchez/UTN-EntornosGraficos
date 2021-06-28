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

function getDayName($day){
    switch($day){
        case 0: {
            $dayName ='Sunday';
            break;
        }
        case 1: {
            $dayName = 'Monday';
            break;
        }
        case 2: {
            $dayName = 'Tuesday';
            break;
        }
        case 3: {
            $dayName = 'Wednesday';
            break;
        }
        case 4: {
            $dayName = 'Thursday';
            break;
        }
        case 5: {
            $dayName = 'Friday';
            break;
        }
        case 6: {
            $dayName = 'Saturday';
            break;
        }
    };

    return $dayName;
}