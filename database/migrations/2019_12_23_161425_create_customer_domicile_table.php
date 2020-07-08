<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerDomicileTable extends Migration
{
    
    public function up()
    {
        Schema::create('customer_domicile', function (Blueprint $table) {
            $table->bigIncrements('id_customer_domicile');
            $table->bigInteger('nid');
            $table->bigInteger('id_domicile')->unsigned();
            $table->tinyInteger('priority');

            $table->foreign('nid')
            ->references('nid')
            ->on('customers')
            ->onDelete('CASCADE')
            ->onUpdate('CASCADE');

            $table->foreign('id_domicile')
            ->references('id_domicile')
            ->on('domiciles')
            ->onDelete('CASCADE')
            ->onUpdate('CASCADE');
            
            $table->timestamps();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('customer_domicile');
    }
}
