<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Subject;
use Illuminate\Support\Facades\DB;

class SubjectUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $users= User::all();

        $subjects = Subject::all();
        $roles = ['titular', 'alternate'];
        $conditions = ['enrolled', 'regular', 'approved']; 

        foreach($subjects as $subject){

            for ($i = 0; $i < 10; $i++) {

                $user = $users->random(1)->first();
                $role = null;

                if($user->type == 'teacher'){

                    $role = $roles[rand(0, 1)];
                    $condition = null;
                }
                
                if($user->type == 'student'){
                    $condition = $conditions[rand(0,2)];   
                    
                }

                DB::table('subject_user')->insert([
                    'user_id' => $user->id,
                    'subject_id' => $subject->id,
                    'role' => $role,
                    'status' =>$condition,
                ]);
            }


        }

    }
}
