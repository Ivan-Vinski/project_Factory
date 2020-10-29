<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Tags extends Migration
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
         * one tag can be in multiple meals
         * one meal can have multiple tags
        */

        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
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