<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoryOrdersTable extends Migration
{

    public function up()
    {
        Schema::create('history_orders', function (Blueprint $table) {
            $table->bigIncrements('id_history_order');
            $table->bigInteger('id_order')->unsigned();
            $table->bigInteger('id_order_status')->unsigned();
            $table->text('observation')->nullable();
            $table->tinyInteger('status');


            $table->foreign('id_order')
                ->references('id_order')
                ->on('orders')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');

            $table->foreign('id_order_status')
                ->references('id_order_status')
                ->on('order_status')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');

            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('history_orders');
    }
}
