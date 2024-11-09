<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnlacesTable extends Migration
{
    public function up()
    {
        Schema::create('enlaces', function (Blueprint $table) {
            $table->id('enlace_id'); // ID personalizado de enlace

            // Clave foránea a la tabla secciones
            $table->unsignedBigInteger('seccion_id');

            // Otros campos de la tabla en español y en snake_case
            $table->string('nombre', 255); // Nombre del enlace
            $table->string('tipo', 255); // Tipo de enlace
            $table->text('valor'); // Valor o URL del enlace

            // Campos de timestamps en español
            $table->timestamps();

            // Soft deletes para eliminación lógica en español
            $table->softDeletes();

            // Relación con la tabla secciones
            $table->foreign('seccion_id')->references('seccion_id')->on('secciones')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('enlaces');
    }
}
