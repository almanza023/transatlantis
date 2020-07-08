<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimePaymentsTable extends Migration
{

    public function up()
    {
        Schema::create('time_payments', function (Blueprint $table) {
            $table->bigIncrements('id_time_payment');
            $table->integer('time_payment')->comment('tiempos de pagos');
            $table->text('description');
        });
    }


    public function down()
    {
        Schema::dropIfExists('time_payments');
    }
}
