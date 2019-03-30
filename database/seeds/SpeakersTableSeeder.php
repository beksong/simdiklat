<?php

use Illuminate\Database\Seeder;
use App\Speaker;

class SpeakersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 20 ; $i++) { 
            $speaker = new Speaker(array(
                'user_id' => random_int(2,100),
                'subject_id' => random_int(1,10)
            ));
            $speaker->save();
        }
    }
}
