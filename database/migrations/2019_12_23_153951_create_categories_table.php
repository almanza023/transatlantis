<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id_category');
            $table->string('name_category',150)->comment('categorias: materiales para construccion');
            $table->text('description');
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
