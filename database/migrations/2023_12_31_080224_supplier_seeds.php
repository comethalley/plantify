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
        Schema::create('supplier_seeds', function (Blueprint $table) {
            $table->id();
            $table->integer('supplier_id');
            $table->integer('uom_id');
            $table->integer('seed_id');
            $table->integer('qty');
            $table->string('qr_code');
            $table->string('status');
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
        Schema::dropIfExists('supplier_seeds');
    }
};
