<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();
        $this->call(UserSeeder::class);
        $this->call(SubjectSeeder::class);
        $this->call(SubjectUserSeeder::class);
        $this->call(MeetingSeeder::class);
        //$this->call(InscriptionSeeder::class);
    }
}
