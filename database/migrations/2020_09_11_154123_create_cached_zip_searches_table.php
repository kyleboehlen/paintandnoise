<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCachedZipSearchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cached_zip_searches', function (Blueprint $table) {
            $table->id(); // PK
            
            // Other Columns
            $table->string('zip_code', 5);
            $table->smallInteger('radius')->unsigned();
            $table->softDeletes();
            $table->timestamp('timestamp');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cached_zip_searches');
    }
}
