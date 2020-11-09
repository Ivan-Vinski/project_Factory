<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class MealTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker::create('App\MealTag');

        /* For each meal we will create newTagFk in table meal_tags
         * (because every meal must have at least one tag)
         */
        for ($newMealFk = 1; $newMealFk <= DB::table('meals')->count(); $newMealFk++) {
            // Make 1 - 5 tags per meal
            $tagsCount = $faker->numberBetween($min = 1, $max = 5);
            for ($i = 0; $i < $tagsCount; $i++) {

                // Get all 'tag_id' values from 'meal_tag' for current meal
                $tagIds = DB::table('meal_tag')->where('meal_id', $newMealFk)->pluck('tag_id');

                do {
                    // Generate new tag_id foreign key
                    $newTagFk = $faker->numberBetween($min = 1, $max = DB::table('tags')->count());
                    // Check if tag FK already exists for current meal
                } while(in_array($newTagFk, $tagIds->all()));

                DB::table('meal_tag')->insert([
                    'meal_id' => $newMealFk,
                    'tag_id' => $newTagFk
                ]);
            }
            
        }
    }
}
