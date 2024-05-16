<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionLikesTable extends Migration
{
    public function up()
    {
        Schema::create('question_likes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('question_id');
            $table->unsignedBigInteger('user_id'); // Assuming you have a users table
            $table->timestamps();

            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unique(['question_id', 'user_id']); // To prevent duplicate likes from the same user on the same question
        });
    }

    public function down()
    {
        Schema::dropIfExists('question_likes');
    }
}
