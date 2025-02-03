<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeccionesTable extends Migration
{
    public function up()
    {
        Schema::create('secciones', function (Blueprint $table) {
            $table->id('seccion_id'); // ID personalizado de seccion

            // Otros campos de la tabla en español y en snake_case
            $table->string('etiqueta', 255); // Tag
            $table->string('titulo_h1', 255); // H1
            $table->string('titulo_seo', 255); // SEO title
            $table->text('descripcion_seo')->nullable(); // SEO description
            $table->text('url_video')->nullable(); // URL del video
            $table->text('datos')->nullable(); // Datos adicionales

            // Campos de timestamps en español
            $table->timestamps();

            // Soft deletes para eliminación lógica en español
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('secciones');
    }
}
