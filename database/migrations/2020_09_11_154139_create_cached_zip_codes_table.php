<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCachedZipCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cached_zip_codes', function (Blueprint $table) {
            // PK is composite, see constraints
            
            // More Columns
            $table->bigInteger('searches_id')->unsigned(); // References ID on cached_zip_searches
            $table->string('zip_code', 5);

            // Constraints
            $table->foreign('searches_id')->references('id')->on('cached_zip_searches');
            $table->primary(['searches_id', 'zip_code']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cached_zip_codes');
    }
}
