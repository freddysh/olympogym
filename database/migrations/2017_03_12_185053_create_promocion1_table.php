<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromocion1Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promocion', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo');
            $table->longText('detalle');
            $table->decimal('precio',8,2);
            $table->string('tipoDuracion');
            $table->integer('duracion');
            $table->integer('estado');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promocion');
    }
}
