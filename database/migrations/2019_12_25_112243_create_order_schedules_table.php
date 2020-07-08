<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderSchedulesTable extends Migration
{

    public function up()
    {
        Schema::create('order_schedules', function (Blueprint $table) {
            $table->bigIncrements('id_order_schedule');
            $table->bigInteger('id_order')->unsigned();
            $table->text('description')->comment('descripcion del despacho de un pedido');
            $table->date('date_departure')->comment('fecha de salida');
            $table->time('time_departure')->comment('hora de salida');
            $table->tinyInteger('status')->comment('estado: terminado/en proceso');

            $table->foreign('id_order')
                ->references('id_order')
                ->on('orders')
                ->onDelete('RESTRICT')
                ->onUpdate('CASCADE');

            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('order_schedules');
    }
}
