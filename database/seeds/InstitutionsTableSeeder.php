<?php

use Illuminate\Database\Seeder;
use App\Institution;

class InstitutionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $institution = new Institution(array(
            'name' => 'Badan Pengembangan Sumber Daya Manusia Daerah',
            'slug' => str_slug('Badan Pengembangan Sumber Daya Manusia Daerah')
        ));
        $institution->save();

        $institution = new Institution(array(
            'name' => 'Badan Kepegawaian Kota Palu',
            'slug' => str_slug('Badan Kepegawaian Kota Palu')
        ));
        $institution->save();

        $institution = new Institution(array(
            'name' => 'Badan Kepegawaian Kab. Donggala',
            'slug' => str_slug('Badan Kepegawaian Kab. Donggala')
        ));
        $institution->save();

        $institution = new Institution(array(
            'name' => 'Badan Kepegawaian Kab. Sigi',
            'slug' => str_slug('Badan Kepegawaian Kab. Sigi')
        ));
        $institution->save();

        $institution = new Institution(array(
            'name' => 'Badan Kepegawaian Kab. Parigi',
            'slug' => str_slug('Badan Kepegawaian Kab. Parigi')
        ));
        $institution->save();

        $institution = new Institution(array(
            'name' => 'Badan Kepegawaian Kab. Poso',
            'slug' => str_slug('Badan Kepegawaian Kab. Poso')
        ));
        $institution->save();

        $institution = new Institution(array(
            'name' => 'Badan Kepegawaian Kab. Tojo Una-una',
            'slug' => str_slug('Badan Kepegawaian Kab. Tojo Una-una')
        ));
        $institution->save();

        $institution = new Institution(array(
            'name' => 'Badan Kepegawaian Kab. Luwuk',
            'slug' => str_slug('Badan Kepegawaian Kab. Luwuk')
        ));
        $institution->save();

        $institution = new Institution(array(
            'name' => 'Badan Kepegawaian Kab. Banggai',
            'slug' => str_slug('Badan Kepegawaian Kab. Banggai')
        ));
        $institution->save();

        $institution = new Institution(array(
            'name' => 'Badan Kepegawaian Kab. Banggai Kepulauan',
            'slug' => str_slug('Badan Kepegawaian Kab. Banggai Kepulauan')
        ));
        $institution->save();

        $institution = new Institution(array(
            'name' => 'Badan Kepegawaian Kab. Buol',
            'slug' => str_slug('Badan Kepegawaian Kab. Buol')
        ));
        $institution->save();

        $institution = new Institution(array(
            'name' => 'Badan Kepegawaian Kab. Toli-toli',
            'slug' => str_slug('Badan Kepegawaian Kab. Toli-toli')
        ));
        $institution->save();
    }
}
