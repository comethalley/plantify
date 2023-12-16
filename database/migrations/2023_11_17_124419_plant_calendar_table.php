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
        Schema::create('plant_calendars', function (Blueprint $table) {
            $table->id();
            $table->string('crops');
            $table->string('planting_month');
            $table->date('planting_date');
            $table->date('harvest_date');
            $table->string('companion');
            $table->string('status');
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
        Schema::dropIfExists('plant_calendars');
    }
};
