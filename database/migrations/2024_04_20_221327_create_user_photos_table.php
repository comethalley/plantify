<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPhotosTable extends Migration
{
    public function up()
    {
        Schema::create('user_photos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('profile_photo')->nullable();
            $table->string('cover_photo')->nullable();
            $table->string('bio')->nullable(); // Bagong field
            $table->string('address')->nullable(); // Bagong field
            $table->string('email')->nullable(); // Bagong field
            $table->string('facebook')->nullable(); // Bagong field
            $table->string('instagram')->nullable(); // Bagong field
            $table->string('twitter')->nullable(); // Bagong field
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_photos');
    }
}
