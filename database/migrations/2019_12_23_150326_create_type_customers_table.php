<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypeCustomersTable extends Migration
{
    
    public function up()
    {
        Schema::create('type_customers', function (Blueprint $table) {
            $table->bigIncrements('id_type_customer');
            $table->string('type_customer',150);
            $table->text('description')->comment('descripcion especial para tipos de usuarios');
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('type_customers');
    }
}
