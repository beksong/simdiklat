<?php

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
        // $this->call(UsersTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(InstitutionsTableSeeder::class);
        $this->call(PicsTableSeeder::class);
        $this->call(SubjectsTableSeeder::class);
        $this->call(SpeakersTableSeeder::class);
        $this->call(TrainingsTableSeeder::class);
    }
}
