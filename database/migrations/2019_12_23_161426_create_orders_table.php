<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{

    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id_order');
            $table->bigInteger('id_customer_domicile')->unsigned();
            $table->bigInteger('id_type_payment')->unsigned();
            $table->bigInteger('id_time_payment')->unsigned();
            $table->dateTime('date_order')->comment('fecha y hora de orden');
            $table->integer('discount')->nullable()->comment('Aplicacion de descuento');
            $table->tinyInteger('priority')->comment('nivel de prioridad');

           
            $table->foreign('id_customer_domicile')
                ->references('id_customer_domicile')
                ->on('customer_domicile')
                ->onDelete('RESTRICT')
                ->onUpdate('CASCADE');

           
            $table->foreign('id_type_payment')
                ->references('id_type_payment')
                ->on('type_payments')
                ->onDelete('RESTRICT')
                ->onUpdate('CASCADE');

            $table->foreign('id_time_payment')
                ->references('id_time_payment')
                ->on('time_payments')
                ->onDelete('RESTRICT')
                ->onUpdate('CASCADE');


            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
