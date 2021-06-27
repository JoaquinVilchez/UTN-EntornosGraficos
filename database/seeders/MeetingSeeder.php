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
        $classrooms = ['300', '301', '302', '400', '401', '402', '403'];
        $hours = ['12:00','12:15','12:30', '12:45', '13:00','13:15','13:30', '13:45','14:00','14:15','14:30', '14:45', '15:00','15:15','15:30', '15:45','16:00','16:15','16:30', '16:45', '17:00','17:15','17:30', '17:45','18:00','18:15','18:30', '18:45', '19:00','19:15','19:30', '19:45','20:00'];
        $urls = ['https://meet.google.com/rqp=30', 'https://meet.google.com/rqp=20', 'https://meet.google.com/rqp=10'];
        $minDateTime = new DateTime();
        $maxDateTime = new DateTime('+2 months');

        foreach($subjects as $subject) 
        {
            for ($i = 0; $i < 3; $i++)
            {
                //$dateTime_timestamp =  rand($minDateTime->getTimestamp(), $maxDateTime->getTimestamp());
                //$dateTime = date('Y-m-d H:i:s', $dateTime_timestamp);
                
                $day = rand(0,6);
                $hour = rand(0, count($hours)-1); 
                $type = $types[rand(0, 1)];
                $teacher = $subject->teachers()->random(1)->first();
                $status = 'active';
                $classroom = null;
                $url = null;

                if ($type == 'virtual') {
                    $url = $urls[rand(0, 2)];
                }
                if ($type == 'face-to-face') {
                    $classroom = $classrooms[rand(0, 6)];
                }

                Meeting::create([
                    'teacher_id' => $teacher->id,
                    'subject_id' => $subject->id,
                    'type' => $type,
                    'day' => $day,
                    'hour'=> $hour,
                    'status' => $status,
                    'classroom' => $classroom,
                    'meeting_url' => $url,

                ]);


            } 
        }
    }
}
