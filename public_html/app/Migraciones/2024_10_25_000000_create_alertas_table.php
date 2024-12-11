<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlertasTable extends Migration
{
    public function up()
    {
        Schema::create('alertas', function (Blueprint $table) {
            $table->id('alerta_id'); // ID personalizado para la alerta
            $table->unsignedBigInteger('empresa_id'); // ID de la empresa
            $table->string('tipo', 100); // Tipo de alerta
            $table->text('comentarios')->nullable(); // Comentarios adicionales

            // Campos de auditoría personalizados
            $table->timestamp('fecha_creacion')->nullable();
            $table->timestamp('fecha_actualizacion')->nullable();
            
            // SoftDeletes
            $table->softDeletes('fecha_eliminacion');

            // Timestamps
            $table->timestamps();

            // Llave foránea
            $table->foreign('empresa_id')->references('empresa_id')->on('empresas')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('alertas');
    }
}
