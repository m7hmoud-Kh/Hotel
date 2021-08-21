<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('fname',50);
            $table->string('lname',50);
            $table->enum('status',[1,2,3,4,5])->comment('1 => Receptionist , 2 => Room attendant , 3 => Doorman , 4 => Poter , 5 => Chefs');
            $table->string('contact_address',150);
            $table->string('image')->nullable();
            $table->decimal('salay',8,2);
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
        Schema::dropIfExists('employees');
    }
}
