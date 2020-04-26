<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesPostsTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories_posts_types', function (Blueprint $table) {
            // PK is composite, see constraints
            
            // More Columns
            $table->smallInteger('categories_id')->unsigned(); // References ID on categories
            $table->tinyInteger('types_id')->unsigned(); // References ID on posts_types

            // Constraints
            $table->foreign('categories_id')->references('id')->on('categories');
            $table->foreign('types_id')->references('id')->on('posts_types');
            $table->primary(['categories_id', 'types_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories_posts_types');
    }
}
