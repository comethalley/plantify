<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileOtherInfoTable extends Migration
{
    public function up()
    {
        Schema::create('profileotherinfo', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->string('city')->nullable();
            $table->integer('age')->nullable();
            $table->enum('sex', ['male', 'female'])->nullable();
            $table->string('bio')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('profileotherinfo');
    }
}
