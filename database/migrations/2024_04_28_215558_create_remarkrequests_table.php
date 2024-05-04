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
        Schema::create('remarkrequests', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('request_id');
            $table->string('remarks')->nullable();
            $table->string('remark_status');
            $table->string('validated_by');
            $table->date('date_return')->nullable();
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
        Schema::dropIfExists('remarkrequest');
    }
};
