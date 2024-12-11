<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id('usuario_id'); // Identificador del usuario
            $table->string('identificacion', 100); // Identificación del usuario
            $table->string('nombre', 255); // Nombre del usuario
            $table->string('apellido', 200); // Apellido del usuario
            $table->string('email', 190); // Email del usuario
            $table->string('posicion', 250)->nullable(); // Posición o cargo
            $table->timestamp('email_verificado_en')->nullable(); // Fecha de verificación de email
            $table->string('contrasena', 255); // Contraseña
            $table->string('token_recordar', 100)->nullable(); // Token de recordar sesión
            $table->unsignedBigInteger('empresa_id')->nullable(); // Clave foránea a la tabla empresas

            // Auditoría personalizada
            $table->unsignedBigInteger('usuario_creado')->nullable();
            $table->unsignedBigInteger('usuario_actualizado')->nullable();
            $table->unsignedBigInteger('usuario_eliminado')->nullable();
            $table->timestamp('fecha_creacion')->nullable();
            $table->timestamp('fecha_actualizacion')->nullable();
            

            // SoftDeletes
            $table->softDeletes('fecha_eliminacion');

            // Timestamps
            $table->timestamps();

            // Llaves foráneas
            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('set null');
            $table->foreign('usuario_creado')->references('usuario_id')->on('usuarios');
            $table->foreign('usuario_actualizado')->references('usuario_id')->on('usuarios');
            $table->foreign('usuario_eliminado')->references('usuario_id')->on('usuarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
}
