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
        Schema::create('plantifeeds', function (Blueprint $table) {
            $table->id();
            $table->string('post_title');
            $table->text('body');
            $table->string('image'); // assuming the file path is a string
            $table->string('createdby');
            $table->string('status');
            $table->timestamps(); // This will add created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plantifeeds');
    }
};