<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Helpers
use App\Http\Helpers\Functions\SeedHelper;

class CreatePostersStatusesTable extends Migration
{
    const SEED_CLASS = 'PostersStatusesSeed';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posters_statuses', function (Blueprint $table) {
            // PK
            $table->tinyIncrements('id');
            
            // Other Columns
            $table->string('name', 255);
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
        Schema::dropIfExists('posters_statuses');
    }
}
