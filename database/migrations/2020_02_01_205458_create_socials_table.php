<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Helpers
use App\Http\Helpers\Functions\SeedHelper;

class CreateSocialsTable extends Migration
{
    const SEED_CLASS = 'SocialsSeed';

    /**
     * Run the migrations.
     *
     * @return void
     */
    
    public function up()
    {
        Schema::create('socials', function (Blueprint $table) {
            // PK
            $table->tinyIncrements('id');

            // More columns
            $table->string('name', 255);
            $table->string('url', 255);
            $table->string('icon_identifier', 255);
            $table->string('profile_link_pattern', 255);
        });

        SeedHelper::seedClass(self::SEED_CLASS);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('socials');
    }
}
