<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehicleStatusTable extends Migration
{
    
    public function up()
    {
        Schema::create('vehicle_status', function (Blueprint $table) {
            $table->bigIncrements('id_vehicle_status');
            $table->string('name', 100)->comment('estados:reparacion/funcionando...');
            $table->text('description');
            $table->integer('order_by');
            $table->timestamps();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('vehicle_status');
    }
}
