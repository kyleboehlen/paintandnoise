<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            // PK
            $table->bigIncrements('id');

            // Laravel Columns
            $table->timestamps();
            $table->softDeletes();

            // More Columns
            $table->smallInteger('categories_id')->unsigned();
            $table->bigInteger('users_id')->unsigned();
            $table->tinyInteger('types_id')->unsigned();
            $table->json('asset'); // For storing file URI/resource URL
            $table->boolean('nsfw')->default($value = false);
            $table->mediumInteger('total_votes')->unsigned()->default($value = 0);

            // Constraints
            $table->foreign('categories_id')->references('id')->on('categories');
            $table->foreign('users_id')->references('id')->on('users');
            $table->foreign('types_id')->references('id')->on('posts_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
