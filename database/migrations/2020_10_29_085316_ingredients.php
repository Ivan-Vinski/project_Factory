<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Ingredients extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
        * M:N
        * one ingredient can be in multiple meals
        * one meal can have multiple ingredients
       */
        Schema::create('ingredients', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
        });

        Schema::create('ingredient_translations', function(Blueprint $table) {
            $table->id();
            //$table->integer('post_id')->unsigned();
            $table->string('locale')->index(); // language
            $table->string('title');

            $table->unique(['ingredient_id', 'locale']);
        
            //$table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');

            $table->foreignId('ingredient_id')->constrained()->onDelete('cascade');
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
