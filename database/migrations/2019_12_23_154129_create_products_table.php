<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{

    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id_product');
            $table->bigInteger('id_type_unit')->unsigned();
            $table->bigInteger('id_category')->unsigned();
            $table->string('name_product', 150);
            $table->text('description');
            $table->tinyInteger('type_price');
            $table->double('weight')->nullable()->comment('peso: kg, l');
            $table->double('volume')->nullable()->comment('volumen: m3..');
            $table->double('price')->nullable()->comment('precio asignado');
            $table->tinyInteger('product_status');

            //$table->string('url');


            $table->foreign('id_type_unit')
                ->references('id_type_unit')
                ->on('type_units')
                ->onDelete('RESTRICT')
                ->onUpdate('CASCADE');

            $table->foreign('id_category')
                ->references('id_category')
                ->on('categories')
                ->onDelete('RESTRICT')
                ->onUpdate('CASCADE');


            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('products');
    }
}
