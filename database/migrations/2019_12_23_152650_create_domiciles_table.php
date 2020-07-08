<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDomicilesTable extends Migration
{
    
    public function up()
    {
        Schema::create('domiciles', function (Blueprint $table) {
            $table->bigIncrements('id_domicile');
            $table->bigInteger('id_municipality')->unsigned();

            $table->text('address');
            $table->text('additional')->nullable();
            $table->string('contact_number', 20);

            $table->foreign('id_municipality')
                ->references('id_municipality')
                ->on('municipalities')
                ->onDelete('RESTRICT')
                ->onUpdate('CASCADE');


            $table->timestamps();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('domiciles');
    }
}
