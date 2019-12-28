<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            // PK
            $table->bigIncrements('id');

            // Laravel Tables
            $table->timestamps(0);
            $table->softDeletes();
            $table->rememberToken();

            // More Columns
            $table->string('name'); // name that displays
            $table->string('slug')->unique()->nullable(); // used in url

            $table->string('email')->unique(); // also used at username for login, user auth
            $table->timestamp('email_verified_at')->nullable();  // casts 

            $table->string('password'); // hidden

            $table->string('phone_number', 10)->nullable(); // only US for now
            $table->timestamp('phone_number_verified_at')->nullable(); // casts
            
            $table->boolean('can_post')->default($value = 0); // Can not post unless verified
            $table->boolean('can_vote')->default($value = 0); // For restricting voting, ghost ban config possible?
            $table->boolean('show_nsfw')->default($value = 0); // For showing nsfw posts or nah

            $table->string('zip_code', 5)->nullable(); // For location filtering in browsing

            $table->string('profile_picture')->nullable(); // Obvs...
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
