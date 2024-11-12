<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoriasTable extends Migration
{
    public function up()
    {
        Schema::create('historias', function (Blueprint $table) {
            $table->id('historia_id'); // ID personalizado de historia
            
            // Clave foránea a la tabla secciones
            $table->unsignedBigInteger('seccion_id'); 

            // Otros campos en español y en snake_case
            $table->string('nombre', 255); // Nombre de la historia
            $table->text('url_video')->nullable(); // URL del video
            $table->text('imagen')->nullable(); // Imagen de la historia

            // Campos de timestamps en español
            $table->timestamps();

            // Soft deletes para eliminación lógica en español
            $table->softDeletes();

            // Definición de la clave foránea
            $table->foreign('seccion_id')->references('id')->on('secciones')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('historias');
    }
}
