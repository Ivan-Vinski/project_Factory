<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('App\Ingredient');
        $counter = 1;
        while ($counter <= 50) {
            $id = DB::table('ingredients')->insertGetId([
                'slug' => 'IngredientSlugNo'.$counter
            ]);

            DB::table('ingredient_translations')->insert([
                'locale' => 'hr',
                'title' => 'Ingredient-title'.$counter.'-HR',
                'ingredient_id' => $id
            ]);

            DB::table('ingredient_translations')->insert([
                'locale' => 'en',
                'title' => 'Ingredient-title'.$counter.'-EN',
                'ingredient_id' => $id
            ]);

            DB::table('ingredient_translations')->insert([
                'locale' => 'fr',
                'title' => 'Ingredient-title'.$counter++.'-FR',
                'ingredient_id' => $id
            ]);
        }

    }
}
