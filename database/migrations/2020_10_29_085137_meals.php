<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Meals extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meals', function(Blueprint $table) {
            $table->id();
            $table->string('status');
            $table->timestamps();
            $table->softDeletes();

            // Meal can belong to exaclty one or zero categories
            /*
             * One way to write it 
             * $table->bigInteger('category_id')->unsigned()->nullable();
             * $table->foreign('category_id')->references('id')->on('categories');
            */
            // Another, faster way
            $table->foreignId('category_id')->nullable()->constrained();
        });

        Schema::create('meal_translations', function(Blueprint $table) {
            $table->id();
            //$table->integer('post_id')->unsigned();
            $table->string('locale')->index(); // language
            $table->string('title');
            $table->string('description');

            $table->unique(['meal_id', 'locale']);
        
            //$table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');

            $table->foreignId('meal_id')->constrained()->onDelete('cascade');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
