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
        Schema::create('cropsplanteds', function (Blueprint $table) {
            $table->id();
            $table->string("farm_id");
            $table->string("crops");
            $table->string("area");
            $table->date("date_planted");
            $table->date("target_harvest");
            $table->date("harvest_date");
            $table->string("farm_status_id");
            $table->string("status");
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
        Schema::dropIfExists('cropsplanted');
    }
};