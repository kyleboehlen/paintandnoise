<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_users', function (Blueprint $table) {
            // PK
            $table->bigIncrements('id');

            // Laravel Tables
            $table->timestamps(0);
            $table->softDeletes();

            // More Columns
            $table->string('name'); // for easily managing admin accounts by super admin
            $table->string('email')->unique(); // used as username on login, admin auth
            $table->string('password'); // hidden
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_users');
    }
}
