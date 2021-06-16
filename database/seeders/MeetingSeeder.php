<?php

namespace Database\Seeders;

use App\Models\Meeting;
use Illuminate\Database\Seeder;
use App\Models\Subject;
use DateTime;
use Illuminate\Support\Facades\DB;

class MeetingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $subjects = Subject::all();
        $types = ['virtual', 'face-to-face'];
        $classrooms = ['300','301', '302', '400', '401', '402', '403']; 
        $urls = ['https://meet.google.com/rqp=30','https://meet.google.com/rqp=20','https://meet.google.com/rqp=10'];
        $states = ['pending', 'canceled','confirmed'];
        $alternativeDate = null;
        $reason = null;
        $minDateTime = new DateTime('2021-06-16');
        $maxDateTime = new DateTime('2021-08-16');
        

        for ($i = 0; $i < 150 ; $i++) {
            $subject = $subjects->random(1)->first();
            $dateTime_timestamp =  rand($minDateTime->getTimestamp(),$maxDateTime->getTimestamp());
            $dateTime = date('Y-m-d H:i:s', $dateTime_timestamp);
            $state = $states[rand(0,2)];
            $type = $types [rand(0,1)];
            $teacher = $subject->teachers()->random(1)->first();
            $classroom = null;
            $url = null;
            $reason = null;


            if ($type == 'virtual')
            {
                $url = $urls[rand(0,2)];
            }
            if ($type == 'face-to-face')
            {
                $classroom = $classrooms[rand(0,6)];
            }

            if($state == 'canceled')
            {
                $reason = 'consulta cancelada';
            }

            Meeting::create([
                'profesor_id' => $teacher->id,
                'subject_id' => $subject->id,
                'type' => $type,
                'datetime'=>$dateTime,
                'alternative_datetime'=>$alternativeDate,
                'state' =>$state,
                'classroom'=>$classroom,
                'meeting_url'=>$url,
                'reason'=>$reason,

            ]);
            
        }
          


    }
}
