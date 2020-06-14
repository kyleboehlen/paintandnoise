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
        $colors = array_values(config('categories.colors'));

        Schema::create('categories', function (Blueprint $table) use ($colors) {
            // PK
            $table->smallIncrements('id');

            // More Tables
            $table->string('name', 100);
            $table->smallInteger('parent_id')->unsigned()->nullable(); // References parent category ID
            $table->enum('color', $colors)->nullable();
            $table->string('slug')->unique(); // As to not expose the category IDs

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
