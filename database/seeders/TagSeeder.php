<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\MealTag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('App\Tag');
        $counter = 1;

        while($counter <= 15) {
            $id = DB::table('tags')->insertGetId([
                'slug' => 'TagSlugNo'.$counter
            ]);

            DB::table('tag_translations')->insert([
                'locale' => 'hr',
                'title' => 'Tag-Title'.$counter.'-HR',
                'tag_id' => $id
            ]);

            DB::table('tag_translations')->insert([
                'locale' => 'en',
                'title' => 'Tag-Title'.$counter.'-EN',
                'tag_id' => $id
            ]);

            DB::table('tag_translations')->insert([
                'locale' => 'fr',
                'title' => 'Tag-Title'.$counter++.'-FR',
                'tag_id' => $id
            ]);
        }
    }
}
