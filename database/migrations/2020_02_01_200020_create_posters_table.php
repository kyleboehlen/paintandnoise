<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posters', function (Blueprint $table) {
            // PK
            $table->uuid('id')->primary(); // UID to use without exposing user_ids

            // Laravel Columns
            $table->timestamps();
            $table->softDeletes();

            // Other Columns
            $table->bigInteger('users_id')->unsigned()->unique();
            $table->string('slug', 8)->nullable($value = true)->unique();
            $table->tinyInteger('status_id')->default($value = 3)->unsigned(); // Default value = 'Applied'
            $table->string('bio', 255)->nullable($value = true);
            $table->char('verification_token', 6); // Alpha numeric

            // Constraints
            $table->foreign('users_id')->references('id')->on('users');
            $table->foreign('status_id')->references('id')->on('posters_statuses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posters');
    }
}
