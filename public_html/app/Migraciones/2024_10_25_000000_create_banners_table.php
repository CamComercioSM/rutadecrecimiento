<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannersTable extends Migration
{
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->id('banner_id'); // ID personalizado de banner

            // Otros campos de la tabla en español y en snake_case
            $table->string('nombre', 255); // Nombre del banner
            $table->string('titulo', 255); // Título del banner
            $table->text('imagen')->nullable(); // Imagen asociada al banner
            $table->text('descripcion')->nullable(); // Descripción del banner
            $table->string('texto_boton', 100)->nullable(); // Texto del botón
            $table->text('url')->nullable(); // URL del banner

            // Timestamps de Laravel en español
            $table->timestamps();

            // Soft deletes para eliminación lógica en español
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('banners');
    }
}
