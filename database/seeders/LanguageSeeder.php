<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('App\Category');
        // Controll languages here or we could take them from App::locale
        $locales = ['hr', 'en', 'fr'];

        foreach($locales as $locale) {
            DB::table('languages')->insert([
                'locale' => $locale
            ]);
        }

    }
}
