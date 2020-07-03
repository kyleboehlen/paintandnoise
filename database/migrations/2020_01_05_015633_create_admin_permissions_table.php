<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Helpers
use App\Http\Helpers\Functions\SeedHelper;

class CreateAdminPermissionsTable extends Migration
{
    const SEED_CLASS = 'AdminPermissionsSeed';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_permissions', function (Blueprint $table) {
            // PK
            $table->smallIncrements('id');

            // More Columns
            $table->string('name', 64);
            $table->string('description', 254)->nullable($value = true);
            $table->smallInteger('tools_id')->unsigned();

            // Constraints
            $table->foreign('tools_id')->references('id')->on('admin_tools');
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
        Schema::dropIfExists('admin_permissions');
    }
}
