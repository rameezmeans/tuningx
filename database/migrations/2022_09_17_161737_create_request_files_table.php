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
        Schema::create('request_files', function (Blueprint $table) {
            $table->id();
            $table->string('request_file');
            $table->string('file_type');
            $table->string('ecu_file_select')->nullable();
            $table->string('gearbox_file_select')->nullable();
            $table->string('master_tools');
            $table->string('tool_type');
            $table->foreignId('file_id')->constrained()->cascadeOnDelete();
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
        Schema::dropIfExists('request_files');
    }
};
