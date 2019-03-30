<?php

use Illuminate\Database\Seeder;
use App\Pic;

class PicsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for ($i=0; $i < 20; $i++) { 
            # code...
            $pic = new Pic(array(
                'user_id'=>random_int(2,100),
                'institution_id' => random_int(1,12)
            ));
            $pic->save();
        }
    }
}
