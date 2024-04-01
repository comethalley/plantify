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
        Schema::create('createplantings', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('start');
            $table->text('end');
            $table->text('status')->nullable();
            $table->text('farm_id')->nullable();
            $table->text('harvested')->nullable();
            $table->text('destroyed')->nullable();
            $table->text('seed')->nullable();
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
        Schema::dropIfExists('createplantings');
    }
};