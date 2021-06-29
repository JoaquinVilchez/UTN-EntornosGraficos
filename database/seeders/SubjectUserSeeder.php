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

        $teachers= User::all()->where('type', 'teacher');
        $students= User::all()->where('type', 'student'); 

        $subjects = Subject::all();
        $roles = ['titular', 'alternate'];
        $conditions = ['enrolled', 'regular', 'approved']; 

        foreach($subjects as $subject){

            //Se insertan docentes para la materia
            for ($i = 0; $i < 1; $i++) {

                $user = $teachers->random(1)->first();
                $role = $roles[rand(0, 1)];
                $condition = null;


                DB::table('subject_user')->insert([
                    'user_id' => $user->id,
                    'subject_id' => $subject->id,
                    'role' => $role,
                    'status' =>$condition,
                ]);
            }

            //Se insertan alumnos para la materia
            for($i=0; $i<3; $i++){

                $user = $students->random(1)->first();
                $role = null;
                $condition = $conditions[rand(0,2)];   


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
