<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderDetailsTable extends Migration
{

    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->bigIncrements('id_order_detail');
            $table->bigInteger('id_order')->unsigned();
            $table->bigInteger('id_product')->unsigned();
            $table->integer('amount')->comment('cantidad de pedido');
            $table->double('unit_price');

            $table->foreign('id_order')
                ->references('id_order')
                ->on('orders')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');

            $table->foreign('id_product')
                ->references('id_product')
                ->on('products')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');


            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('order_details');
    }
}
