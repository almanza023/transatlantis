<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderStatusTable extends Migration
{

    public function up()
    {
        Schema::create('order_status', function (Blueprint $table) {
            $table->bigIncrements('id_order_status');
            $table->string('name', 100)->comment('estados:no aprobado/aprobado...');
            $table->text('description')->comment('descripcion de estados');
            $table->integer('order_by');
        });
    }


    public function down()
    {
        Schema::dropIfExists('order_status');
    }
}
