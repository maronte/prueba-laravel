<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tw_empresas_corporativos', function (Blueprint $table) {

            // Columnas

            $table->increments('id');
            $table->string('S_RazonSocial', 150);
            $table->string('S_RFC', 13);


            $table->string('S_Pais', 75)->nullable();
            $table->string('S_Estado', 75)->nullable();
            $table->string('S_Municipio', 75)->nullable();
            $table->string('S_ColoniaLocalidad', 75)->nullable();
            $table->string('S_Domicilio', 100)->nullable();
            $table->integer('N_CodigoPostal')->nullable();

            $table->string('S_UsoCFDI', 45)->nullable();
            $table->string('S_UrlRFC', 450)->nullable();
            $table->string('S_UrlActaConstitutiva', 450)->nullable();

 
            $table->tinyInteger('S_Activo');
            $table->string('S_Comentarios', 255);

            $table->unsignedBigInteger('tw_corporativos_id');

            $table->timestamps();
            $table->softDeletes();

            // LLaves foráneas

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
        Schema::dropIfExists('tw_empresas_corporativos');
    }
}
