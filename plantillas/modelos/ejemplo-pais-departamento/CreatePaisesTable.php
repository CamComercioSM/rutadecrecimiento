<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaisesTable extends Migration
{
    public function up()
    {
        Schema::create('paises', function (Blueprint $table) {
            // Definición del ID personalizado
            $table->unsignedBigInteger('pais_id')->primary(); // ID personalizado
            
            // Otros campos de la tabla
            $table->string('nombre', 100); // Nombre del país

            // Campos de auditoría
            $table->unsignedBigInteger('usuario_creo')->nullable(); // ID del usuario que creó
            $table->timestamp('fecha_creacion')->useCurrent(); // Fecha de creación
            $table->unsignedBigInteger('usuario_actualizo')->nullable(); // ID del usuario que actualizó
            $table->timestamp('fecha_actualizacion')->nullable(); // Fecha de actualización
            $table->unsignedBigInteger('usuario_elimino')->nullable(); // ID del usuario que eliminó
            $table->timestamp('fecha_eliminacion')->nullable(); // Fecha de eliminación

            // Soft deletes para eliminación lógica
            $table->softDeletes(); // Agrega la columna deleted_at

            // Clave foránea (si corresponde)
            // $table->unsignedBigInteger('padre_id')->nullable(); // Relación con la tabla padre
            // $table->foreign('padre_id')->references('padre_id')->on('TablaPadre')->onDelete('restrict');

            $table->timestamps(); // Si quieres incluir created_at y updated_at, aunque aquí ya tenemos campos personalizados
        });
    }

    public function down()
    {
        Schema::dropIfExists('paises');
    }
}
