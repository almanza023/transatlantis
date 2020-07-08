<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypeProvidersTable extends Migration
{
    
    public function up()
    {
        Schema::create('type_providers', function (Blueprint $table) {
            $table->bigIncrements('id_type_provider');
            $table->string('type_provider',150);
            $table->text('description');
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('type_providers');
    }
}
