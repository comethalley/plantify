<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFarmsArchiveTable extends Migration
{
    public function up()
    {
        Schema::create('archivefarms', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('old_id');
            $table->string('barangay_name');
            $table->string('farm_name');
            $table->string('address');
            $table->string('area');
            $table->string('farm_leader');
            $table->string('status');
            $table->string('title_land');
            $table->string('picture_land');
            // Add other columns as needed
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('archivefarms');
    }
}
