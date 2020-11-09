<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class MealSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('App/Meal');
        $counter = 1;
        while($counter <= 50) { // create 50 meals

            // Meal created anytime between two years ago and now
            $created_at = $faker->dateTimeBetween('-2 years', 'now');

            /* Last update anytime between creation and now
             * 30% - updated
             * 70% - not updated / null value
             */
            $updated_at = $faker->optional($weight = 0.3)->dateTimeBetween($created_at, 'now');

            /*
             * It is assumed that meals with status 'deleted' cannot be updated
             * Hence they could have only been deleted between 'updated_at' and 'now'
             * or 'created_at' and 'now'
             */
            if ($updated_at == NULL) {
                // 15% - deleted
                // 85% - not deleted / null value
                $deleted_at = $faker->optional($weight = 0.15)->dateTimeBetween($created_at, 'now');
            }
            else {
                $deleted_at = $faker->optional($weight = 0.15)->dateTimeBetween($updated_at, 'now');
            }

            if ($deleted_at != NULL) {
                $status = 'deleted';
            }
            else if ($updated_at != NULL) {
                $status = 'updated';
            }
            else {
                $status = 'created';
            }
            

            $id = DB::table('meals')->insertGetId([
                'created_at' => $created_at,
                'updated_at' => $updated_at,
                'deleted_at' => $deleted_at,
                'status' => $status,
                /* Created 10 categories, so need optional FKs in range 1-10
                 * 80% - have category
                 * 20% - will not have category
                 */
                'category_id' => $faker->optional($weight = 0.8)->numberBetween(1, 10)
            ]);

            DB::table('meal_translations')->insert([
                'locale' => 'hr',
                'title' => 'Meal-Title-'.$counter.'-HR',
                'description' => 'Meal-Description-'.$counter.'-HR',
                'meal_id' => $id,
    
            ]);
    
            DB::table('meal_translations')->insert([
                'locale' => 'en',
                'title' => 'Meal-Title-'.$counter.'-EN',
                'description' => 'Meal-Description-'.$counter.'-EN',
                'meal_id' => $id,
    
            ]);
    
            DB::table('meal_translations')->insert([
                'locale' => 'fr',
                'title' => 'Meal-Title-'.$counter.'-FR',
                'description' => 'Meal-Description-'.$counter++.'-FR',
                'meal_id' => $id,
            ]);
        }
    }
}
