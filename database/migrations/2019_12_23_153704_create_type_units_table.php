<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypeUnitsTable extends Migration
{

    public function up()
    {
        Schema::create('type_units', function (Blueprint $table) {
            $table->bigIncrements('id_type_unit');
            $table->string('type_unit', 150)->comment('unidad en peso/volumen');
            $table->text('description');
        });
    }


    public function down()
    {
        Schema::dropIfExists('type_units');
    }
}
