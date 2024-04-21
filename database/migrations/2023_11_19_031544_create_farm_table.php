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
        Schema::create('farms', function (Blueprint $table) {
            $table->id();
            $table->string('barangay_name');
            $table->string('farm_name');
            $table->string('address');
            $table->string('area');
            $table->string('farm_leader');
            $table->string('status');
            $table->binary('title_land');
            $table->binary('picture_land');
            $table->binary('picture_land1')->nullable();
            $table->binary('picture_land2')->nullable();
            $table->date('select_date')->nullable();
            $table->string('email')->nullable();
            $table->timestamps();
        
            // Define foreign key constraint
        //    
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('farms');
    }
};