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
        Schema::create('survey_survlists', function (Blueprint $table) {
            // Auto-incrementing id field of type bigInteger
            $table->id();

            // Survey_id and foreign relation
            $table->BigInteger('survey_id')->unsigned();
            $table->foreign('survey_id')->references('id')->on('surveys');

            // Session_id and foreign relation
            $table->BigInteger('survlist_id')->unsigned();
            $table->foreign('survlist_id')->references('id')->on('survlists');

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
        Schema::dropIfExists('session_survlists');
    }
};
