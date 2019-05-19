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
        $pic = new Pic(array(
            'user_id'=> '1',
            'institution_id' => '1'
        ));
        $pic->save();
    }
}
