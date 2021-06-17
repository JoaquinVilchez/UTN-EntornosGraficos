<?php

namespace Database\Seeders;

use App\Models\Inscription;
use App\Models\Meeting;
use Illuminate\Database\Seeder;
use App\Models\Subject;

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

        foreach($meetings as $meeting){
           $subject = Subject::find($meeting->subject_id);
           $students = $subject->students();
           $student = $students->random(1)->first();
           $cant_inscriptions_for_meeting = rand(0,5);

            for ($i=0; $i<=$cant_inscriptions_for_meeting; $i++){
                $state = $states[rand(0,3)];
                
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
