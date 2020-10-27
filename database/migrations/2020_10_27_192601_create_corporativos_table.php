<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCorporativosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tw_corporativos', function (Blueprint $table) {
            // No se encontró forma 
            $table->id();
            $table->string('S_NombreCorto',45);
            $table->string('S_NombreCompleto',75);

            // Atributo pendiente de validación
            $table->string('S_LogoURL',450)->nullable();

            $table->string('S_DBName',45);
            $table->string('S_DBUsuario',45);
            $table->string('S_DBPassword',45);
            $table->string('S_SystemURL',450);
            $table->tinyInteger('S_Activo');
            $table->timestamp('D_FechaIncorporación');
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tw_corporativos');
    }
}
