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
        Schema::create('remarkfarms', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('farm_id');
            $table->string('remarks')->nullable();
            $table->string('remark_status');
            $table->string('validated_by');
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
        Schema::dropIfExists('remarkfarms');
    }
};
