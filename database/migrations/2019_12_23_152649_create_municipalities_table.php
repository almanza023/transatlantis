<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMunicipalitiesTable extends Migration
{

    public function up()
    {
        Schema::create('municipalities', function (Blueprint $table) {
            $table->bigIncrements('id_municipality');
            $table->bigInteger('id_departament')->unsigned();
            $table->string('name_municipality', 150);

            $table->foreign('id_departament')
                ->references('id_departament')
                ->on('departaments')
                ->onDelete('RESTRICT')
                ->onUpdate('CASCADE');
        });
    }


    public function down()
    {
        Schema::dropIfExists('municipalities');
    }
}
