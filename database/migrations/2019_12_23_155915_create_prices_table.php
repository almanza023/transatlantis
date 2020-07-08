<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePricesTable extends Migration
{

    public function up()
    {
        Schema::create('prices', function (Blueprint $table) {
            $table->bigIncrements('id_price');
            $table->bigInteger('id_product')->unsigned();
            $table->date('effective_date')->comment('fecha vigencia');
            $table->date('expiration_date')->nullable()->comment('fecha expiracion');
            $table->double('price')->comment('precio en ese rango de fecha');
            $table->tinyInteger('price_status');


            $table->foreign('id_product')
                ->references('id_product')
                ->on('products')
                ->onDelete('RESTRICT')
                ->onUpdate('CASCADE');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('prices');
    }
}
