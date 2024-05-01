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
        Schema::create('event_attendances', function (Blueprint $table) {
            $table->id();
            $table->string('event_id');
            $table->string('name');
            $table->integer('age');
            $table->string('email');
            $table->integer('contact');
            $table->string('address');
            $table->string('barangay');
            // Add more fields as needed
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
        Schema::dropIfExists('event_attendances');
    }
};