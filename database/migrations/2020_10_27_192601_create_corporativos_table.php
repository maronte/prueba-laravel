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
            $table->id();
            $table->string('S_NombreCorto',45);
            $table->string('S_NombreCompleto',75);

            // Atributo pendiente de validación
            $table->string('S_LogoURL')->nullable();

            $table->string('S_DBName',45);
            $table->string('S_DBUsuario',45);
            $table->string('S_DBPassword',45);
            $table->string('S_SystemURL',255);
            $table->smallInteger('S_Activo',1);
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
