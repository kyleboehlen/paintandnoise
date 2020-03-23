<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('votes', function (Blueprint $table) {
            // PK is composite, see constraints
            
            // More Columns
            $table->bigInteger('posts_id')->unsigned(); // References ID on posts
            $table->bigInteger('users_id')->unsigned(); // References ID on users

            // Constraints
            $table->foreign('posts_id')->references('id')->on('posts');
            $table->foreign('users_id')->references('id')->on('users');
            $table->primary(['posts_id', 'users_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('votes');
    }
}
