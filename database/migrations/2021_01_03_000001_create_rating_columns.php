<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatingColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void Returns nothing.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->float('rating')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void Returns nothing.
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('rating');
        });
    }
}
