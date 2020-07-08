<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseOrderDetailsTable extends Migration
{

    public function up()
    {
        Schema::create('purchase_order_details', function (Blueprint $table) {
            $table->bigIncrements('id_purchase');
            $table->bigInteger('nit');
            $table->bigInteger('id_order_detail')->unsigned();
            $table->integer('amount')->comment('cantidad de orden');
            $table->double('cost')->nullable()->comment('precio compra: no usable*');

            $table->foreign('nit')
                ->references('nit')
                ->on('providers')
                ->onDelete('RESTRICT')
                ->onUpdate('CASCADE');

            $table->foreign('id_order_detail')
                ->references('id_order_detail')
                ->on('order_details')
                ->onDelete('RESTRICT')
                ->onUpdate('CASCADE');

            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('purchase_order_details');
    }
}
