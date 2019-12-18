<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_categories', function (Blueprint $table) {
            // PK is composite, see constraints
            
            // More Columns
            $table->smallInteger('categories_id')->unsigned(); // References ID on categories
            $table->bigInteger('users_id')->unsigned(); // References ID on users

            // Constraints
            $table->foreign('categories_id')->references('id')->on('categories');
            $table->foreign('users_id')->references('id')->on('users');
            $table->primary(['categories_id', 'users_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_categories');
    }
}
