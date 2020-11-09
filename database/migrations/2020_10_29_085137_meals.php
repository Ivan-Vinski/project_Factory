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
            $table->foreignId('category_id')->nullable()->constrained();
        });

        Schema::create('meal_translations', function(Blueprint $table) {
            $table->id();
            $table->string('locale')->index(); // language
            $table->string('title');
            $table->string('description');

            $table->unique(['meal_id', 'locale']);
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
