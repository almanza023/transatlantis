<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderScheduleDetailsTable extends Migration
{

    public function up()
    {
        Schema::create('order_schedule_details', function (Blueprint $table) {
            $table->bigIncrements('id_order_schedule_details');
            $table->bigInteger('id_order_schedule')->unsigned();
            $table->string('placa', 50);
            $table->text('description_carga')->comment('descripcion de lo que lleva');
            $table->time('time_return')->nullable()->comment('hora de regreso');
            $table->double('time_stimated')->nullable()->comment('tiempo estimado de viaje');
            $table->integer('nro_viaje')->nullable()->comment('numero de viajes');
            $table->tinyInteger('status');

            $table->foreign('id_order_schedule')
                ->references('id_order_schedule')
                ->on('order_schedules')
                ->onDelete('RESTRICT')
                ->onUpdate('CASCADE');

            $table->foreign('placa')
                ->references('placa')
                ->on('vehicles')
                ->onDelete('RESTRICT')
                ->onUpdate('CASCADE');

            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('order_schedule_details');
    }
}
