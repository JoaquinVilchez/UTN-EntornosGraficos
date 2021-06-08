<?php

use App\Models\Subject;



if(!function_exists('get_subjects_for_level')){
    function get_subjects_for_level($level){
        
        $subjects =  Subject::all()->where('level',$level);
        return $subjects;            
    
    }
        
}

