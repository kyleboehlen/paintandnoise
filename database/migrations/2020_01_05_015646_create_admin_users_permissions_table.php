<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminUsersPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_users_permissions', function (Blueprint $table) {
            // Composite PK
            $table->bigInteger('admin_users_id')->unsigned();
            $table->smallInteger('admin_permissions_id')->unsigned();

            // More Columns
            $table->dateTime('expires')->nullable($value = true);
            
            // Laravel Columns
            $table->softDeletes();
            $table->timestamps();

            // Constraints
            $table->primary(['admin_users_id', 'admin_permissions_id', ], 'admin_users_permissions_pk');
            $table->foreign('admin_users_id')->references('id')->on('admin_users');
            $table->foreign('admin_permissions_id')->references('id')->on('admin_permissions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_users_permissions');
    }
}
