<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAplicacionesTable extends Migration
{
    public function up()
    {
        Schema::create('aplicaciones', function (Blueprint $table) {
            // Definición del ID personalizado
            $table->unsignedBigInteger('aplicacion_id')->primary(); // ID personalizado de aplicación
            
            // Claves foráneas
            $table->unsignedBigInteger('programa_id'); // Relación con la tabla programas
            $table->unsignedBigInteger('empresa_id'); // Relación con la tabla empresas

            // Otros campos
            $table->string('estado', 50); // Estado de la aplicación
            $table->text('comentarios')->nullable(); // Comentarios sobre la aplicación
            $table->string('archivo')->nullable(); // Ruta al archivo asociado con la aplicación

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
            $table->foreign('programa_id')->references('programa_id')->on('programas')->onDelete('cascade');
            $table->foreign('empresa_id')->references('empresa_id')->on('empresas')->onDelete('cascade');
            $table->foreign('usuario_creo')->references('usuario_id')->on('usuarios')->onDelete('set null');
            $table->foreign('usuario_actualizo')->references('usuario_id')->on('usuarios')->onDelete('set null');
            $table->foreign('usuario_elimino')->references('usuario_id')->on('usuarios')->onDelete('set null');

            $table->timestamps(); // Timestamps de Laravel
        });
    }

    public function down()
    {
        Schema::dropIfExists('aplicaciones');
    }
}
