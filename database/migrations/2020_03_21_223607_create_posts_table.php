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
            $table->uuid('id')->primary(); // UID to use without exposing user_ids

            // Laravel Columns
            $table->timestamps();
            $table->softDeletes();

            // More Columns
            $table->smallInteger('categories_id')->unsigned();
            $table->uuid('posters_id');
            $table->tinyInteger('types_id')->unsigned();
            $table->json('asset'); // For storing file URI/resource URL
            $table->boolean('nsfw')->default($value = false);
            $table->mediumInteger('total_votes')->unsigned()->default($value = 0);
            $table->char('vote_token', 16); // Alpha numeric

            // Constraints
            $table->foreign('categories_id')->references('id')->on('categories');
            $table->foreign('posters_id')->references('id')->on('posters');
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
