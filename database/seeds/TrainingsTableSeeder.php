<?php

use Illuminate\Database\Seeder;
use App\Training;
use Carbon\Carbon;
use Illuminate\Support\Str;

class TrainingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 50; $i++) { 
            # code...
            $random = random_int(30,90);
            $t = new Training(array(
                'name' => 'Diklat Prajabatan Angkatan'.random_int(10,100),
                'slug' => str_slug('Diklat Prajabatan Angkatan XXX'),
                'start_date' => Carbon::now()->addDays(random_int(10,100)),
                'period' => $random,
                'end_date' => Carbon::now()->addDays($random),
                'pic_id' => random_int(1,20),
                'description' => Str::random(100),

            ));
            $t->save();
        }
    }
}
