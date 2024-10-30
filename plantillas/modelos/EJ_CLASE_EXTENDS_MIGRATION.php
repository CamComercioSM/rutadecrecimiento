<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEjemploTable extends Migration
{
    /**
     * Ejecutar la migración.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ejemplo', function (Blueprint $table) {
            // Definición del ID personalizado
            $table->unsignedBigInteger('ejemplo_id')->primary(); // ID personalizado
                        
            // Clave foránea
            $table->unsignedBigInteger('padre_id'); // Relación con Tabla Padre
            $table->foreign('padre_id')->references('padre_id')->on('TablaPadre')->onDelete('restrict');
            
            // Otros campos de la tabla...
            $table->string('nombre', 100); // Ejemplo de otro campo

            // Campos de auditoría
            $table->unsignedBigInteger('usuario_creo')->nullable(); // ID del usuario que creó
            $table->timestamp('fecha_creacion')->useCurrent(); // Fecha de creación
            $table->unsignedBigInteger('usuario_actualizo')->nullable(); // ID del usuario que actualizó
            $table->timestamp('fecha_actualizacion')->nullable(); // Fecha de actualización
            $table->unsignedBigInteger('usuario_elimino')->nullable(); // ID del usuario que eliminó
            $table->timestamp('fecha_eliminacion')->nullable(); // Fecha de eliminación

            // Soft deletes para eliminación lógica
            $table->softDeletes(); // Agrega la columna deleted_at
            
             // Para incluir created_at y updated_at 
            $table->timestamps();aunque aquí ya tenemos campos personalizados // aunque aquí ya tenemos campos personalizados
            
        });
    }

    /**
     * Revertir la migración.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ejemplo');
    }
}

?>
