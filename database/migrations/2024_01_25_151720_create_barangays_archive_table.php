<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangaysArchiveTable extends Migration
{
    public function up()
    {
        Schema::create('barangays_archive', function (Blueprint $table) {
            $table->id();
            $table->string('barangay_name');
            // Add other columns as needed
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('barangays_archive');
    }
}