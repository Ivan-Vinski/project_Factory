<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $this->call([
            /*
             * Important to do it in this order
             * because of foreign keys
             */
            LanguageSeeder::class,
            CategorySeeder::class,
            MealSeeder::class,
            IngredientSeeder::class,
            IngredientMealSeeder::class,
            TagSeeder::class,
            MealTagSeeder::class,
        ]);
    }
}
