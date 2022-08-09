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
        Schema::create('responses', function (Blueprint $table) {
            // Auto-incrementing id field of type bigInteger
            $table->id();

            // Survey_id and foreign relation
            $table->BigInteger('question_id')->unsigned();
            $table->foreign('question_id')->references('id')->on('questions');

            // Session_id and foreign relation
            $table->BigInteger('session_id')->unsigned();
            $table->foreign('session_id')->references('id')->on('sessions');

            // Keep score
            $table->Integer('score');

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
        Schema::dropIfExists('responses');
    }
};
