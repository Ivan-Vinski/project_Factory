<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\MealIngredient;

class IngredientMealSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('App\MealIngredient');

        /* For each meal we will create newMealFk in table meal_ingredients
         * (because every meal must have at least one ingredient)
         */
        for ($newMealFk = 1; $newMealFk <= DB::table('meals')->count(); $newMealFk++) {
            // Make 1 - 5 ingredients per meal
            $ingredientsCount = $faker->numberBetween($min = 1, $max = 5);
            for ($i = 0; $i < $ingredientsCount; $i++) {
               
                // Get all 'ingredient_id' values from 'meal_ingredient' for current meal 
                $ingredientIds = DB::table('ingredient_meal')->where('meal_id', $newMealFk)->pluck('ingredient_id');

                do {
                    // Generate new ingredient_id foreign key
                    $newIngredientFk = $faker->numberBetween($min = 1, $max = DB::table('ingredients')->count());
                    // Check if ingredient FK already exists for current meal
                } while(in_array($newIngredientFk, $ingredientIds->all()));


                DB::table('ingredient_meal')->insert([
                    'meal_id' => $newMealFk,
                    'ingredient_id' => $newIngredientFk
                ]);
            }
            
        }
       
    }
}
