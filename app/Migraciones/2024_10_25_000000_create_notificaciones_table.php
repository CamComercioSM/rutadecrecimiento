<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificacionesTable extends Migration
{
    public function up()
    {
        Schema::create('notificaciones', function (Blueprint $table) {
            $table->id('notificacion_id'); // ID personalizado para notificaciones
            $table->string('titulo', 255); // Título de la notificación
            $table->text('descripcion')->nullable(); // Descripción de la notificación
            $table->string('url', 255)->nullable(); // URL asociada a la notificación
            $table->unsignedBigInteger('orden'); // Orden de visualización de la notificación

            $table->unsignedBigInteger('usuario_creo')->nullable(); // ID del usuario que creó
            $table->timestamp('fecha_creacion')->useCurrent(); // Fecha de creación
            $table->unsignedBigInteger('usuario_actualizo')->nullable(); // ID del usuario que actualizó
            $table->timestamp('fecha_actualizacion')->nullable(); // Fecha de actualización
            $table->unsignedBigInteger('usuario_elimino')->nullable(); // ID del usuario que eliminó
            $table->timestamp('fecha_eliminacion')->nullable(); // Fecha de eliminación

            $table->foreign('usuario_creo')->references('id')->on('users')->onDelete('set null');
            $table->foreign('usuario_actualizo')->references('id')->on('users')->onDelete('set null');
            $table->foreign('usuario_elimino')->references('id')->on('users')->onDelete('set null');
            
            $table->softDeletes('fecha_eliminacion');

        });
    }

    public function down()
    {
        Schema::dropIfExists('notificaciones');
    }
}
