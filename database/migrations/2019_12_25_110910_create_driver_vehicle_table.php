<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDriverVehicleTable extends Migration
{

    public function up()
    {
        Schema::create('driver_vehicle', function (Blueprint $table) {
            $table->bigIncrements('id_driver_vehicle');
            $table->string('placa', 50);
            $table->bigInteger('nid_driver');
            $table->dateTime('date_assigment');
            $table->dateTime('date_departure')->nullable();
            $table->tinyInteger('status');

            $table->foreign('placa')
                ->references('placa')
                ->on('vehicles')
                ->onDelete('RESTRICT')
                ->onUpdate('CASCADE');

            $table->foreign('nid_driver')
                ->references('nid_driver')
                ->on('drivers')
                ->onDelete('RESTRICT')
                ->onUpdate('CASCADE');


            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('driver_vehicle');
    }
}
