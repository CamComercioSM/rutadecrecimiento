<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRespuestasTable extends Migration
{
    public function up()
    {
        Schema::create('respuestas', function (Blueprint $table) {
            // Definición del ID personalizado
            $table->unsignedBigInteger('respuesta_id')->primary(); // ID personalizado de respuesta

            // Claves foráneas
            $table->unsignedBigInteger('empresa_id'); // Relación con la tabla empresas
            $table->unsignedBigInteger('diagnostico_id'); // Relación con la tabla diagnosticos
            $table->unsignedBigInteger('aplicacion_id'); // Relación con la tabla aplicaciones
            $table->unsignedBigInteger('variable_id'); // Relación con la tabla variables

            // Otros campos
            $table->text('valor'); // Valor de la respuesta

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
            $table->foreign('diagnostico_id')->references('diagnostico_id')->on('diagnosticos')->onDelete('cascade');
            $table->foreign('aplicacion_id')->references('aplicacion_id')->on('aplicaciones')->onDelete('cascade');
            $table->foreign('variable_id')->references('variable_id')->on('variables')->onDelete('cascade');
            $table->foreign('usuario_creo')->references('usuario_id')->on('usuarios')->onDelete('set null');
            $table->foreign('usuario_actualizo')->references('usuario_id')->on('usuarios')->onDelete('set null');
            $table->foreign('usuario_elimino')->references('usuario_id')->on('usuarios')->onDelete('set null');

            $table->timestamps(); // Timestamps de Laravel
        });
    }

    public function down()
    {
        Schema::dropIfExists('respuestas');
    }
}
