<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProvidersTable extends Migration
{

    public function up()
    {
        Schema::create('providers', function (Blueprint $table) {
            $table->bigInteger('nit')->primary();
            $table->bigInteger('id_type_provider')->unsigned();
            $table->bigInteger('id_municipality')->unsigned();
            $table->string('full_name', 255)->nullable();
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->text('address');
            $table->string('email');
            $table->string('contact_number', 20);
            $table->tinyInteger('provider_status');

            $table->foreign('id_type_provider')
                ->references('id_type_provider')
                ->on('type_providers')
                ->onDelete('RESTRICT')
                ->onUpdate('CASCADE');

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
        Schema::dropIfExists('providers');
    }
}
