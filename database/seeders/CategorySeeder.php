<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('App\Category');
        $counter = 1;
        while ($counter <= 10) { // create 10 categories
            $id = DB::table('categories')->insertGetId([
                'slug' => 'CategorySlugNo'.$counter
            ]);
    
            DB::table('category_translations')->insert([
                'locale' => 'hr',
                'title' => 'Category-Title'.$counter.'-HR',
                'category_id' => $id
            ]);
    
            DB::table('category_translations')->insert([
                'locale' => 'en',
                'title' => 'Category-Title-'.$counter.'-EN',
                'category_id' => $id
            ]);
    
            DB::table('category_translations')->insert([
                'locale' => 'fr',
                'title' => 'Category-Title-'.$counter++.'-FR',
                'category_id' => $id
            ]);
        } 
        

    }
}
