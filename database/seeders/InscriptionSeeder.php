<?php

namespace Database\Seeders;

use App\Models\Inscription;
use App\Models\Meeting;
use Illuminate\Database\Seeder;
use App\Models\Subject;
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

        $meetings = Meeting::all();
        $states = ['enrolled', 'attended', 'not_attended', 'canceled'];
        $rating_review = null;
        $message_review = null;
        $finish_states = ['attended', 'not_attended'];


        $now = new DateTime();

        foreach($meetings as $meeting){
           $subject = Subject::find($meeting->subject_id);
           $students = $subject->students();
           $student = $students->random(1)->first();

           foreach ($students as $student){

                $state = $states[rand(0,3)];
            
                if($meeting->datetime < $now)
                {
                    $state = $finish_states[rand(0,1)];
                }

                if($meeting->state == 'canceled')
                {
                    $state = 'canceled';
                }

                if($meeting->state == 'pending'){
                    $state = 'enrolled';
                }


                    
                Inscription::create([
                    'state' => $state,
                    'meeting_id' => $meeting->id,
                    'student_id' => $student->id,
                    'rating_review' => $rating_review,
                    'message_review' => $message_review

                ]);

           }
        }

        
    }
}
