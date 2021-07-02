<?php

namespace Database\Seeders;

use App\Models\Inscription;
use App\Models\Meeting;
use Illuminate\Database\Seeder;
use App\Models\Subject;
use Carbon\Carbon;
use DateTime;

class InscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $minDateTime = new DateTime();
        $maxDateTime = new DateTime('+2 months');
        
        $meetings = Meeting::all();
        $rating_review = null;
        $message_review = null;


        foreach($meetings as $meeting){

            for ($i = 0; $i < 2; $i++) 
            {
        
                $subject = Subject::find($meeting->subject_id);
                $students = $subject->students();
                $student = $students->random(1)->first();

                foreach ($students as $student)
                {
                    $day = $meeting->day;
                    $hour=$meeting->hour;
                    $datetime = new Carbon(); //Habria que obtener aleatoriamente una fecha basandose en el dia y hora establecido   

                    $status = 'active';
                        
                    Inscription::create([
                        'datetime' => $datetime,
                        'status' => $status,
                        'meeting_id' => $meeting->id,
                        'student_id' => $student->id,
                        'rating_review' => $rating_review,
                        'message_review' => $message_review
                    ]);

                }
            }
        }

        
    }
}
