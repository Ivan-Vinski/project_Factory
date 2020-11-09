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
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
        });

        Schema::create('tag_translations', function(Blueprint $table) {
            $table->id();
            //$table->integer('post_id')->unsigned();
            $table->string('locale')->index(); // language
            $table->string('title');
            $table->unique(['tag_id', 'locale']);
        
            //$table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');

            $table->foreignId('tag_id')->constrained()->onDelete('cascade');
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
