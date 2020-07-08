<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypePaymentsTable extends Migration
{

    public function up()
    {
        Schema::create('type_payments', function (Blueprint $table) {
            $table->bigIncrements('id_type_payment');
            $table->string('type_payment', 150)->comment('tipos de pagos');
            $table->text('description');
        });
    }


    public function down()
    {
        Schema::dropIfExists('type_payments');
    }
}
