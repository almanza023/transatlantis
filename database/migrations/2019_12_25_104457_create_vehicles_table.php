<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehiclesTable extends Migration
{

    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->string('placa', 50)->primary();
            $table->string('model', 50)->comment('modelo del carro');
            $table->string('type_vehicle', 50)->comment('tipo de vehiculos');
            $table->string('brand', 50)->comment('marca vehiculo');
            $table->double('volume')->comment('capacidad en volumen');
            $table->double('capacity')->comment('capacidad en peso');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('vehicles');
    }
}
