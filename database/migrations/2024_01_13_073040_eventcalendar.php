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
        Schema::create('eventcalendar', function (Blueprint $table) {
            $table->id();
            $table->string('category');
            $table->text('title');
            $table->string('event_date');
            $table->string('start_time');
            $table->string('End_time');
            $table->string('event_location');
            $table->string('description');
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
        Schema::dropIfExists('eventcalendar');
    }
};
