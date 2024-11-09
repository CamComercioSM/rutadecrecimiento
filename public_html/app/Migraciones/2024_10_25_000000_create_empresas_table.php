<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresasTable extends Migration
{
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            // Definición del ID personalizado
            $table->unsignedBigInteger('empresa_id')->primary(); // ID personalizado de la empresa
            
            // Otros campos de la tabla
            $table->string('nombre_comercial', 255); // Nombre comercial de la empresa
            $table->text('descripcion')->nullable(); // Descripción de la empresa
            $table->string('nit', 30)->nullable(); // NIT de la empresa
            $table->string('numero_registro', 100)->nullable(); // Número de registro de la empresa
            $table->string('email_registro', 100)->nullable(); // Email de registro
            $table->date('fecha_registro')->nullable(); // Fecha de registro
            $table->char('tamaño', 1)->nullable(); // Tamaño de la empresa
            $table->char('tipo_persona', 1)->nullable(); // Tipo de persona (jurídica/natural)
            $table->char('sector', 1)->nullable(); // Sector de la empresa
            $table->string('ventas_anuales', 255)->nullable(); // Ventas anuales
            $table->string('actividad_comercial', 200)->nullable(); // Actividad comercial
            $table->string('nombre_representante_legal', 255)->nullable(); // Representante legal
            $table->boolean('afiliada')->default(false); // Si está afiliada
            $table->unsignedInteger('departamento_id')->nullable(); // Departamento
            $table->unsignedInteger('municipio_id')->nullable(); // Municipio
            $table->text('direccion')->nullable(); // Dirección
            $table->text('geolocalizacion')->nullable(); // Geolocalización
            $table->string('telefono', 200)->nullable(); // Teléfono
            $table->string('movil', 15)->nullable(); // Móvil
            $table->string('sitio_web')->nullable(); // Sitio web
            $table->string('red_social_instagram', 255)->nullable(); // Instagram
            $table->string('red_social_facebook', 255)->nullable(); // Facebook
            $table->string('red_social_linkedin', 255)->nullable(); // LinkedIn
            $table->string('persona_contacto', 255)->nullable(); // Persona de contacto
            $table->string('email_contacto', 255)->nullable(); // Email de contacto
            $table->string('telefono_contacto', 15)->nullable(); // Teléfono de contacto
            $table->unsignedBigInteger('etapa_id')->nullable(); // ID de la etapa
            $table->boolean('actualizar_info')->default(false); // Si se debe actualizar la información
            $table->boolean('diagnostico_completo')->default(false); // Si completó el diagnóstico
            $table->boolean('mostrar_encuesta')->default(false); // Si mostrar encuesta
            $table->text('logo')->nullable(); // Logo de la empresa
            $table->string('camara_comercio', 2)->nullable(); // Cámara de comercio
            $table->enum('tipo_registro_rutac', ['IDEA', 'INFORMAL', 'FORMAL', 'FORMAL_EXTERNO', 'FORMAL_MAGDALENA'])->nullable(); // Tipo de registro en RutaC
            $table->string('tipo_identificacion', 10)->nullable(); // Tipo de identificación
            $table->string('identificacion', 255)->nullable(); // Identificación de la empresa
            $table->enum('etapa_intervencion', ['CRECIMIENTO', 'TRANSFORMADA', 'INTERVENCION', 'FALLECIMIENTO'])->nullable(); // Etapa de intervención
            $table->timestamp('transformada_fecha')->nullable(); // Fecha de transformación
            $table->unsignedInteger('transformada_en')->nullable(); // ID de dónde fue transformada
            $table->unsignedInteger('transformada_desde')->nullable(); // ID de desde dónde fue transformada

            // Auditoría personalizada
            $table->unsignedBigInteger('usuario_id')->nullable(); // Usuario que gestionó la empresa
            $table->timestamp('fecha_creacion')->useCurrent(); // Fecha de creación
            $table->timestamp('fecha_actualizacion')->nullable(); // Fecha de actualización
            

            // Soft deletes para eliminación lógica
            $table->softDeletes('fecha_eliminacion');

            // Claves foráneas
            $table->foreign('etapa_id')->references('etapa_id')->on('etapas')->onDelete('set null');
            $table->foreign('usuario_id')->references('usuario_id')->on('usuarios')->onDelete('set null');
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('empresas');
    }
}
