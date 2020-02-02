<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostersCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posters_categories', function (Blueprint $table) {
            // PK is composite, see constraints
            
            // More Columns
            $table->smallInteger('categories_id')->unsigned(); // References ID on categories
            $table->char('posters_id', 36); // Posters UUID

            // Constraints
            $table->foreign('categories_id')->references('id')->on('categories');
            $table->foreign('posters_id')->references('id')->on('posters');
            $table->primary(['categories_id', 'posters_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posters_categories');
    }
}
