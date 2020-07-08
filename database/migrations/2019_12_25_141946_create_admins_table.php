<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{

    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->bigIncrements('id_admin');
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->text('address');
            $table->string('email');
            $table->string('contact_number', 20);
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
