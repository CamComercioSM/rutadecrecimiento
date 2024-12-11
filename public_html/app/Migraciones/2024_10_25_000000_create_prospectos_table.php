<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProspectosTable extends Migration
{
    public function up()
    {
        Schema::create('prospectos', function (Blueprint $table) {
            $table->id('prospecto_id'); // ID personalizado de prospecto

            // Otros campos de la tabla en español y en snake_case
            $table->string('tipo', 255); // Tipo de prospecto
            $table->string('nombre', 255); // Nombre del prospecto
            $table->string('documento', 255); // Documento de identificación
            $table->string('correo', 255); // Email del prospecto
            $table->string('telefono', 255); // Teléfono del prospecto
            $table->text('descripcion')->nullable(); // Descripción del prospecto
            $table->string('departamento', 255); // Departamento del prospecto
            $table->string('municipio', 255); // Municipio del prospecto
            $table->text('direccion')->nullable(); // Dirección del prospecto

            // Campos de timestamps en español
            $table->timestamps();

            // Soft deletes para eliminación lógica en español
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('prospectos');
    }
}
