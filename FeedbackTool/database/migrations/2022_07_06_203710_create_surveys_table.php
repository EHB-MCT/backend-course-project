<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surveys', function (Blueprint $table) {
            // Auto-incrementing id field of type bigInteger
            $table->id();

            // User_id and foreign relation
            $table->BigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            // Name of the list
            $table->string('list_name');

            // Store the creation- and update-time of a row
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('surveys');
    }
};
