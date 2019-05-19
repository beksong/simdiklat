<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User(array(
            'nip' => random_int(1,9999999999999999),
            'address' => 'Jl. Basuki Rahmat I Lrg. Menara I No. 04 Palu',
            'place_birth' => 'Lumajang',
            'date_birth' => '1984-08-26',
            'religion' => 'islam',
            'gender' => 'Laki-laki',
            'name' => 'Aditya Dwiantoro',
            'email' => 'adityadwiantoro@gmail.com',
            'password' => bcrypt('badandiklat')
        ));
        $user->save();
    }
}
