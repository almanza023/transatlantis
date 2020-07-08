<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{

    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigInteger('nid')->primary()->comment('numero identificacion');
            $table->bigInteger('id_type_customer')->unsigned();
            $table->string('full_name', 255)->nullable()->comment('razon social');
            $table->string('first_name', 100)->comment('persona natural o contacto de razon social');
            $table->string('last_name', 100);
            $table->string('email');
           
            $table->foreign('id_type_customer')
                ->references('id_type_customer')
                ->on('type_customers')
                ->onDelete('RESTRICT')
                ->onUpdate('CASCADE');

            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
