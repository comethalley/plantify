
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
        Schema::create('archivefarms', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('old_id');
            $table->string('barangay_name');
            $table->string('farm_name');
            $table->string('address');
            $table->string('area');
            $table->string('farm_leader');
            $table->string('status');
            $table->binary('title_land');
            
            // Change 'picture_land' to use BLOB
            $table->binary('picture_land');
            
            // Change 'picture_land1' to use BLOB and allow nullable
            $table->binary('picture_land1')->nullable();
            
            // Change 'picture_land2' to use BLOB and allow nullable
            $table->binary('picture_land2')->nullable();
            // Add other columns as needed
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('archivefarms');
    }
};
