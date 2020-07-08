<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryVehiclesTable extends Migration
{

    public function up()
    {
        Schema::create('history_vehicles', function (Blueprint $table) {
            $table->bigIncrements('id_history_vehicle');
            $table->string('placa', 50);
            $table->bigInteger('id_vehicle_status')->unsigned();
            $table->text('observation');
            $table->tinyInteger('status');

            $table->foreign('placa')
                ->references('placa')
                ->on('vehicles')
                ->onDelete('RESTRICT')
                ->onUpdate('CASCADE');

            $table->foreign('id_vehicle_status')
                ->references('id_vehicle_status')
                ->on('vehicle_status')
                ->onDelete('RESTRICT')
                ->onUpdate('CASCADE');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('history_vehicles');
    }
}
