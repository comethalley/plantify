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
        Schema::create('request_tbl', function (Blueprint $table) {
            $table->id();
            $table->string('supply_type');
            $table->integer('supply_count');
            $table->binary('letter_content');
            $table->string('requested_by');
            $table->string('status');
            $table->date('date_return');
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
        Schema::dropIfExists('request_tbl');
    }
};
