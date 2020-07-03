<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Helpers
use App\Http\Helpers\Functions\SeedHelper;

class CreateAdminToolsTable extends Migration
{
    const SEED_CLASS = 'AdminToolsSeed';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_tools', function (Blueprint $table) {
            // PK
            $table->smallIncrements('id');

            // More Columns
            $table->string('name', 64);
            $table->string('route_name', 64)->nullable($value = true);
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
        Schema::dropIfExists('admin_tools');
    }
}
