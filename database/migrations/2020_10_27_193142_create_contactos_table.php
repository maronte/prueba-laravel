<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tw_contactos_corporativos', function (Blueprint $table) {

            // Columnas

            $table->increments('id');
            $table->string('S_Nombre',45);
            $table->string('S_Puesto',45);
            $table->string('S_Comentarios',255)->nullable();

            // Se usó biginteger para permitir la longitud del número
            $table->bigInteger('N_TelefonoFijo')->nullable();
            $table->bigInteger('N_TelefonoMovil')->nullable();
            $table->string('S_Email',255);
            $table->unsignedBigInteger('tw_corporativos_id')->unique();
            $table->timestamps();
            // $table->softDeletes();

            // Llaves foráneas
            $table->foreign('tw_corporativos_id')->references('id')->on('tw_corporativos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tw_contactos_corporativos');
    }
}
