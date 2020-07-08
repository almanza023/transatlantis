<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartamentsTable extends Migration
{

    public function up()
    {
        Schema::create('departaments', function (Blueprint $table) {
            $table->bigIncrements('id_departament');
            $table->string('name_departament', 150);
        });
    }


    public function down()
    {
        Schema::dropIfExists('departaments');
    }
}
