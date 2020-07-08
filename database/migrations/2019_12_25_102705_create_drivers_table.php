<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDriversTable extends Migration
{

    public function up()
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->bigInteger('nid_driver')->primary()->comment('numero identificacion');
            $table->string('first_name', 100)->comment('persona natural o contacto de razon social');
            $table->string('last_name', 100);
            $table->text('address');
            $table->string('email');
            $table->string('contact_number', 20);
            $table->string('contact_number_second', 20)->nullable();
            $table->char('blood_type', 4)->comment('tipo de sangre');
            $table->date('date_birth')->comment('fecha nacimiento');
            $table->text('medical_observation')->nullable()->comment('observacion medica');
            $table->text('place_care')->nullable()->comment('lugar de atencion');
            $table->string('arl', 50);
            $table->tinyInteger('driver_status');

            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('drivers');
    }
}
