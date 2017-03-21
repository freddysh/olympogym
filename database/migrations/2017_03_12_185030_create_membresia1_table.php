<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembresia1Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('membresia', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('cliente_id');
            $table->integer('promocion_id');
            $table->date('fechaInicio');
            $table->date('fechaFin');
            $table->decimal('total',8,2);
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
        Schema::dropIfExists('membresia');
    }
}
