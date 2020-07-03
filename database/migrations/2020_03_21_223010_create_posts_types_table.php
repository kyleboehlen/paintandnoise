<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Helpers
use App\Http\Helpers\Functions\SeedHelper;

class CreatePostsTypesTable extends Migration
{
    const SEED_CLASS = 'PostsTypesSeed';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts_types', function (Blueprint $table) {
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
        Schema::dropIfExists('posts_types');
    }
}
