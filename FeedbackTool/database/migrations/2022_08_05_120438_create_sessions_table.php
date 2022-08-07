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
        Schema::create('sessions', function (Blueprint $table) {
            // Auto-incrementing id field of type bigInteger
            $table->id();

            // Caretaker_id and foreign relation
            $table->BigInteger('caretaker_id')->unsigned();
            $table->foreign('caretaker_id')->references('id')->on('users');

            // Client_id and foreign relation
            $table->BigInteger('client_id')->unsigned();
            $table->foreign('client_id')->references('id')->on('users');

            // Survlist_id
            $table->BigInteger('survlist_id')->unsigned();
            $table->foreign('survlist_id')->references('id')->on('survlists');

            // Open_status
            $table->Boolean('open_status')->default(0);

            // Filled_status
            $table->Boolean('filled_status')->default(0);

            // Filled_status
            $table->Timestamp('duration_time');

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
        Schema::dropIfExists('sessions');
    }
};
