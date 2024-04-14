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
        Schema::create('plant_infos', function (Blueprint $table) {
            $table->id();
            $table->string("plant_name");
            $table->string("image");
            $table->string("seasons");
            $table->text("information");
            $table->string("companion");
            $table->string("days_harvest");
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
        Schema::dropIfExists('plant_infos');
    }
};
