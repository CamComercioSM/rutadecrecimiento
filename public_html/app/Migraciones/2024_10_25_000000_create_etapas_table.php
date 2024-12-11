<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEtapasTable extends Migration
{
    public function up()
    {
        Schema::create('etapas', function (Blueprint $table) {
            // Definición del ID personalizado
            $table->unsignedBigInteger('etapa_id')->primary(); // ID personalizado de etapa
            
            // Otros campos de la tabla
            $table->string('nombre', 200); // Nombre de la etapa
            $table->text('imagen')->nullable(); // Imagen asociada a la etapa
            $table->text('descripcion')->nullable(); // Descripción de la etapa
            $table->unsignedBigInteger('etapa_anterior_id')->nullable(); // Clave foránea a la etapa anterior
            $table->unsignedBigInteger('etapa_siguiente_id')->nullable(); // Clave foránea a la siguiente etapa
            $table->float('puntuacion_inicial', 8, 4)->nullable(); // Puntuación inicial
            $table->float('puntuacion_final', 8, 4)->nullable(); // Puntuación final

            // Campos de auditoría personalizados
            $table->unsignedBigInteger('usuario_creo')->nullable(); // ID del usuario que creó
            $table->timestamp('fecha_creacion')->useCurrent(); // Fecha de creación
            $table->unsignedBigInteger('usuario_actualizo')->nullable(); // ID del usuario que actualizó
            $table->timestamp('fecha_actualizacion')->nullable(); // Fecha de actualización
            $table->unsignedBigInteger('usuario_elimino')->nullable(); // ID del usuario que eliminó
            $table->timestamp('fecha_eliminacion')->nullable(); // Fecha de eliminación

            // Soft deletes para eliminación lógica
            $table->softDeletes(); // Agrega la columna deleted_at

            // Clave foránea a la misma tabla (etapa anterior y siguiente)
            $table->foreign('etapa_anterior_id')->references('etapa_id')->on('etapas')->onDelete('set null');
            $table->foreign('etapa_siguiente_id')->references('etapa_id')->on('etapas')->onDelete('set null');

            // Claves foráneas para los usuarios que gestionan auditoría
            $table->foreign('usuario_creo')->references('usuario_id')->on('usuarios')->onDelete('set null');
            $table->foreign('usuario_actualizo')->references('usuario_id')->on('usuarios')->onDelete('set null');
            $table->foreign('usuario_elimino')->references('usuario_id')->on('usuarios')->onDelete('set null');
            
            $table->timestamps(); // Incluye created_at y updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('etapas');
    }
}
