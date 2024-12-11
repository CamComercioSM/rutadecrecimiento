<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCapsulasTable  extends Migration
{
    public function up()
    {
        Schema::create('capsulas', function (Blueprint $table) {
            // Definición del ID personalizado
            $table->unsignedBigInteger('capsula_id')->primary(); // ID personalizado de cápsula

            // Otros campos de la tabla
            $table->string('nombre', 255); // Nombre de la cápsula
            $table->text('descripcion')->nullable(); // Descripción de la cápsula
            $table->string('url_video', 255)->nullable(); // URL del video de la cápsula
            $table->string('imagen', 255)->nullable(); // Imagen asociada a la cápsula

            // Campos de auditoría personalizados
            $table->unsignedBigInteger('usuario_creo')->nullable(); // ID del usuario que creó
            $table->timestamp('fecha_creacion')->useCurrent(); // Fecha de creación
            $table->unsignedBigInteger('usuario_actualizo')->nullable(); // ID del usuario que actualizó
            $table->timestamp('fecha_actualizacion')->nullable(); // Fecha de actualización
            $table->unsignedBigInteger('usuario_elimino')->nullable(); // ID del usuario que eliminó
            $table->timestamp('fecha_eliminacion')->nullable(); // Fecha de eliminación

            // Soft deletes para eliminación lógica
            $table->softDeletes(); // Agrega la columna deleted_at

            // Claves foráneas para los usuarios que gestionan auditoría
            $table->foreign('usuario_creo')->references('usuario_id')->on('usuarios')->onDelete('set null');
            $table->foreign('usuario_actualizo')->references('usuario_id')->on('usuarios')->onDelete('set null');
            $table->foreign('usuario_elimino')->references('usuario_id')->on('usuarios')->onDelete('set null');

            $table->timestamps(); // Si quieres incluir created_at y updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('capsulas');
    }
}
