<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVariablesTable extends Migration
{
    public function up()
    {
        Schema::create('variables', function (Blueprint $table) {
            $table->id('variable_id'); // ID personalizado para la variable
            $table->string('nombre', 255); // Nombre de la variable
            $table->string('tipo', 100); // Tipo de la variable
            $table->text('valores')->nullable(); // Valores de la variable
            $table->string('grupo_variable', 255)->nullable(); // Grupo al que pertenece la variable
            $table->string('dimension', 255)->nullable(); // Dimensión de la variable
            $table->integer('porcentaje')->nullable(); // Porcentaje asociado
            $table->string('relacionado_con', 255)->nullable(); // Relación con algún otro aspecto
            $table->boolean('relacionado_con_ventas')->default(false); // Indica si está relacionado con ventas
            $table->unsignedBigInteger('programa_id'); // ID del programa asociado

            // Campos de auditoría personalizados
            $table->timestamp('fecha_creacion')->nullable();
            $table->timestamp('fecha_actualizacion')->nullable();
            

            // SoftDeletes
            $table->softDeletes('fecha_eliminacion');

            // Timestamps
            $table->timestamps();

            // Llave foránea
            $table->foreign('programa_id')->references('programa_id')->on('programas')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('variables');
    }
}
