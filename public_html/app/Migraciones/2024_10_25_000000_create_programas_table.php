<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramasTable extends Migration
{
    public function up()
    {
        Schema::create('programas', function (Blueprint $table) {
            // Definición del ID personalizado
            $table->unsignedBigInteger('programa_id')->primary(); // ID personalizado de programa
            
            // Otros campos de la tabla
            $table->string('nombre', 255); // Nombre del programa
            $table->text('descripcion')->nullable(); // Descripción del programa
            $table->text('logo')->nullable(); // Logo del programa
            $table->text('beneficios')->nullable(); // Beneficios del programa
            $table->text('requisitos')->nullable(); // Requisitos del programa
            $table->string('duracion', 100)->nullable(); // Duración del programa
            $table->string('dirigido_a', 255)->nullable(); // A quién está dirigido el programa
            $table->text('objetivo')->nullable(); // Objetivo del programa
            $table->text('determinantes')->nullable(); // Determinantes del programa
            $table->text('procedimiento_imagen')->nullable(); // Procedimiento para la imagen
            $table->text('herramientas_requeridas')->nullable(); // Herramientas requeridas
            $table->boolean('es_virtual')->default(false); // Si el programa es virtual
            $table->string('persona_encargada', 255)->nullable(); // Persona encargada del programa
            $table->string('email_contacto', 255)->nullable(); // Email de contacto
            $table->string('telefono_contacto', 100)->nullable(); // Teléfono de contacto
            $table->text('info_adicional')->nullable(); // Información adicional
            $table->string('sitio_web', 255)->nullable(); // Sitio web del programa

            // Campos personalizados para la convocatoria
            $table->string('convocatoria_titulo', 255)->nullable(); // Título de la convocatoria
            $table->date('convocatoria_fecha_apertura')->nullable(); // Fecha de apertura de la convocatoria
            $table->date('convocatoria_fecha_cierre')->nullable(); // Fecha de cierre de la convocatoria
            $table->integer('convocatoria_tiempo_actividad')->nullable(); // Tiempo de actividad de la convocatoria
            $table->string('convocatoria_con_matricula', 255)->nullable(); // Información sobre la matrícula

            // Auditoría personalizada
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

            $table->timestamps(); // Si quieres incluir created_at y updated_at, aunque ya tenemos campos personalizados
        });
    }

    public function down()
    {
        Schema::dropIfExists('programas');
    }
}
