<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostersSocialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posters_socials', function (Blueprint $table) {
            // Composite PK
            $table->char('posters_id', 36); // Posters UUID
            $table->tinyInteger('socials_id')->unsigned();

            // Laravel Columns
            $table->timestamps();
            $table->softDeletes();

            // Other Columns
            $table->string('value', 255);
            $table->boolean('verified')->default($value = 0);

            // Constraints
            $table->primary(['posters_id', 'socials_id']);
            $table->foreign('posters_id')->references('id')->on('posters');
            $table->foreign('socials_id')->references('id')->on('socials');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posters_socials');
    }
}
