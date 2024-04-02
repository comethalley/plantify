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
        Schema::create('harvests', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount', 8, 2);
            $table->string('month');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('harvests');
    }
};
