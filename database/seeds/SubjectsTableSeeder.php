<?php

use Illuminate\Database\Seeder;
use App\Subject;

class SubjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subject = new Subject(array(
            'name' => 'Wawasan Kebangsaan',
            'slug' => str_slug('Wawasan Kebangsaan')
        ));    
        $subject->save();
        
        $subject = new Subject(array(
            'name' => 'Nasionalisme',
            'slug' => str_slug('Nasionalisme')
        ));    
        $subject->save();

        $subject = new Subject(array(
            'name' => 'Etika Publik',
            'slug' => str_slug('Etika Publik')
        ));    
        $subject->save();

        $subject = new Subject(array(
            'name' => 'Anti Korupsi',
            'slug' => str_slug('Anti Korupsi')
        ));    
        $subject->save();

        $subject = new Subject(array(
            'name' => 'Pelayanan Prima',
            'slug' => str_slug('Pelayanan Prima')
        ));    
        $subject->save();

        $subject = new Subject(array(
            'name' => 'Etos Kerja',
            'slug' => str_slug('Etos Kerja')
        ));    
        $subject->save();

        $subject = new Subject(array(
            'name' => 'K3',
            'slug' => str_slug('K3')
        ));    
        $subject->save();

        $subject = new Subject(array(
            'name' => 'Keprotokoleran',
            'slug' => str_slug('Keprotokoleran')
        ));    
        $subject->save();

        $subject = new Subject(array(
            'name' => 'Akuntabilitas',
            'slug' => str_slug('Akuntabilitas')
        ));    
        $subject->save();

        $subject = new Subject(array(
            'name' => 'Etika dalam Pelayanan',
            'slug' => str_slug('Etika dalam Pelayanan')
        ));    
        $subject->save();
    }
}
