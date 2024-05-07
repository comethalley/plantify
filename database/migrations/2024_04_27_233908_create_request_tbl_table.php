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
            $table->string('supply_tool')->nullable();
            $table->string('supply_tool1')->nullable();
            $table->string('supply_tool2')->nullable();
            $table->integer('count_tool')->nullable();
            $table->integer('count_tool1')->nullable();
            $table->integer('count_tool2')->nullable();

            $table->string('supply_seedling')->nullable();
            $table->string('supply_seedling1')->nullable();
            $table->string('supply_seedling2')->nullable();
            $table->integer('count_seedling')->nullable();
            $table->integer('count_seedling1')->nullable();
            $table->integer('count_seedling2')->nullable();

            $table->binary('letter_content');
            $table->string('requested_by');
            $table->string('status');
            $table->date('picked_date')->nullable();
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
        Schema::dropIfExists('request_tbl');
    }
};
