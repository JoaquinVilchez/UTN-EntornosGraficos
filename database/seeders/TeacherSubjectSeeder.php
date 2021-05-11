<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Subject;
use Illuminate\Support\Facades\DB;

class TeacherSubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teachers = User::where('type', 'teacher')->get();
        $subjects = Subject::all();
        $roles = ['titular', 'alternate'];

        for ($i = 0; $i < count($subjects); $i++) {

            $teacher = $teachers->random(1)->first();
            $subject = $subjects->random(1)->first();
            $roles[rand(0, 1)];

            DB::table('teacher_subject')->insert([
                'teacher_id' => $teacher->id,
                'subject_id' => $subject->id,
                'role' => $roles[rand(0, 1)],
            ]);
        }
    }
}
