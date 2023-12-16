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
        Schema::create('crops_planteds', function (Blueprint $table) {
            $table->id();
            $table->string("farm_id");
            $table->string("crops");
            $table->string("area");
            $table->date("date_planted");
            $table->string("target_harvest");
            $table->date("harvested_date");
            $table->string("companion");
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
        Schema::dropIfExists('crops_planteds');
    }
};
