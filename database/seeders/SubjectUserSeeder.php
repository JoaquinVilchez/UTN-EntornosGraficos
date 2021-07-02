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

        $users = User::all();

        $subjects = Subject::all();
        $roles = ['titular', 'alternate'];
        $conditions = ['not_enrolled', 'enrolled', 'regular', 'approved'];
        $condition = null;

        for ($i = 0; $i < count($subjects); $i++) {

            $user = $users->random(1)->first();
            $subject = $subjects->random(1)->first();
            $role = null;


            if ($user->type == 'teacher') {

                $role = $roles[rand(0, 1)];
                $condition = null;
            } else if ($user->type == 'student') {
                $condition = $conditions[rand(0, 3)];
            }

            DB::table('subject_user')->insert([
                'user_id' => $user->id,
                'subject_id' => $subject->id,
                'role' => $role,
                'status' => $condition,
            ]);
        }
    }
}
