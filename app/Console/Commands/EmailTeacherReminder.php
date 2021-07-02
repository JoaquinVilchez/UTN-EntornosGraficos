<?php

namespace App\Console\Commands;

use App\Mail\CanceledMeetingNotification;
use App\Mail\teachersNextDayMeetingsMail;
use App\Mail\TeachersNextDayMeetingsMail as MailTeachersNextDayMeetingsMail;
use App\Models\CanceledMeetings;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class EmailTeacherReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envia un correo recordatorio a los docentes con las consultas siguientes.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $teachers = User::all()->where('type','teacher');

        foreach($teachers as $teacher)
        {
        
            $meetings = $teacher->meetings->where('day', Carbon::tomorrow()->dayOfWeek);
            $availableMeetings = new Collection();
    
            foreach($meetings as $meeting)
            {
                $datetime = Carbon::tomorrow()->setTimeFromTimeString($meeting->hour);
                $canceledMeetings = $meeting->canceledMeetings->where('datetime', $datetime->format('Y-m-d H:i:s'));
                
                if(! $canceledMeetings->first()) //not canceled meeting
                {
                    $availableMeetings->push($meeting);
                }
            }
    
    
            $data = ['meetings'=>$availableMeetings, 'teacher_name'=>$teacher->name];
            Mail::to($teacher->email)->send(new MailTeachersNextDayMeetingsMail($data));
    

        }



    }
}
