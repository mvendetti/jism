<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCameraStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('camera_statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('camera_serial_number')->index();
            $table->text('raw')->nullable();
            $table->text('parsed')->nullable();
            $table->text('unparsed')->nullable();
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
        Schema::dropIfExists('camera_statuses');
    }
}
