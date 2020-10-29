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
            $table->string('title');
            $table->string('description');
            $table->string('status');

            // Meal can belong to exaclty one or zero categories
            $table->foreign('category')->nullable();
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
