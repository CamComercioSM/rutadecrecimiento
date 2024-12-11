<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiagnosticosTable extends Migration
{
    public function up()
    {
        Schema::create('diagnosticos', function (Blueprint $table) {
            // Definición del ID personalizado
            $table->unsignedBigInteger('diagnostico_id')->primary(); // ID personalizado de diagnóstico

            // Claves foráneas
            $table->unsignedBigInteger('empresa_id'); // Relación con la tabla empresas
            $table->unsignedBigInteger('etapa_id'); // Relación con la tabla etapas

            // Otros campos
            $table->float('puntuacion', 8, 2); // Puntuación del diagnóstico

            // Campos de auditoría personalizados
            $table->unsignedBigInteger('usuario_creo')->nullable(); // ID del usuario que creó
            $table->timestamp('fecha_creacion')->useCurrent(); // Fecha de creación
            $table->unsignedBigInteger('usuario_actualizo')->nullable(); // ID del usuario que actualizó
            $table->timestamp('fecha_actualizacion')->nullable(); // Fecha de actualización
            $table->unsignedBigInteger('usuario_elimino')->nullable(); // ID del usuario que eliminó
            $table->timestamp('fecha_eliminacion')->nullable(); // Fecha de eliminación

            // Soft deletes para eliminación lógica
            $table->softDeletes(); // Agrega la columna deleted_at

            // Relaciones de claves foráneas
            $table->foreign('empresa_id')->references('empresa_id')->on('empresas')->onDelete('cascade');
            $table->foreign('etapa_id')->references('etapa_id')->on('etapas')->onDelete('cascade');
            $table->foreign('usuario_creo')->references('usuario_id')->on('usuarios')->onDelete('set null');
            $table->foreign('usuario_actualizo')->references('usuario_id')->on('usuarios')->onDelete('set null');
            $table->foreign('usuario_elimino')->references('usuario_id')->on('usuarios')->onDelete('set null');

            $table->timestamps(); // Timestamps de Laravel
        });
    }

    public function down()
    {
        Schema::dropIfExists('diagnosticos');
    }
}
