<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            // PK
            $table->smallIncrements('id');

            // More Tables
            $table->string('name', 100);
            $table->smallInteger('parent_id')->unsigned()->nullable(); // References parent category ID
            $table->string('color', 100)->nullable();

            // Constraints
            $table->foreign('parent_id')->references('id')->on('categories'); // See, it references parent category ID right here! Wow!
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
