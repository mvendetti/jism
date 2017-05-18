<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCamerasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cameras', function (Blueprint $table) {
            $table->string('serial_number')->primary();
            $table->integer('pod_id')->index()->nullable();
            $table->enum('pod_side', ['unassigned', 'left', 'right'])->default('unassigned')->index();
            $table->string('ip')->unique();
            $table->string('mac')->unique();
            $table->string('ssid')->index();
            $table->integer('model_number');
            $table->string('model_name');
            $table->string('firmware_version');
            $table->boolean('online')->default(false)->index();
            $table->boolean('is_recording')->default(false)->index();
            $table->text('settings')->nullable();
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
        Schema::dropIfExists('cameras');
    }
}
