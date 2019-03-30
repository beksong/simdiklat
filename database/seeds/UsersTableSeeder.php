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
            'name' => Str::random(10),
            'email' => 'superadmin@mail.com',
            'address' => Str::random(100),
            'password' => bcrypt('123456'),
            'place_birth' => Str::random(100),
            'date_birth' => Carbon::now(),
            'gender' => 'Laki-laki'
        ));
        $user->save();

        for ($i=0; $i < 100 ; $i++) { 
            $user = new User(array(
                'nip' => random_int(1,9999999999999999),
                'name' => Str::random(10),
                'email' => Str::random(10).'@gmail.com',
                'address' => Str::random(100),
                'password' => bcrypt('secret'),
                'place_birth' => Str::random(100),
                'date_birth' => Carbon::now(),
                'gender' => 'Perempuan'
            ));
            $user->save();
        }
    }
}
