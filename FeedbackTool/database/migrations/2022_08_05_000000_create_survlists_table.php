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
        Schema::create('survlists', function (Blueprint $table) {
            // Auto-incrementing id field of type bigInteger
            $table->id();

            // Survey_combination_id
            $table->String('list_name');

            // Open_status
            $table->Text('description');

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
        Schema::dropIfExists('survlists');
    }
};
