<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('type_id');
            $table->unsignedBigInteger('images_id');
            $table->enum('status',[1,2])->default(1)->comment('1=>not reservation , 2=> reservation');
            $table->foreign('type_id')->references('id')->on('roomtypes')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('images_id')->references('id')->on('room_images')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('rooms');
    }
}
