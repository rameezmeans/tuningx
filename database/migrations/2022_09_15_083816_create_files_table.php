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
        Schema::create('files', function (Blueprint $table) {
            
            $table->id();
            $table->string('tool');
            $table->string('tool_type');
            $table->string('file_attached');
            $table->string('file_type');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('model_year');
            $table->string('license_plate');
            $table->string('vin_number');
            $table->string('brand');
            $table->string('model');
            $table->string('version');
            $table->string('tools');
            $table->string('gear_box');
            
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
        Schema::dropIfExists('files');
    }
};
