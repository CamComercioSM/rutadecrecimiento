<?php

namespace App\Nova\Actions;

use App\Models\Company;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;

class ExportCompanies extends DownloadExcel{
    use InteractsWithQueue, Queueable;

    public function name(){
        return 'Exportar seleccionados';
    }

    public function headings(): array {
        return [
            'Razon social',
            'NIT',
            'Nombre del representante legal',
            'Numero de matricula',
            'Fecha de matricula',
            'Email registrado',
            'Tipo de persona',
            'Sector',
            'Tamaño',
            'Actividad económica',
            'Afiliado',
            'Departamento',
            'Municipio',
            'Dirección',
            'Teléfono',
            'Celular',
            'Sitio web',
            'Persona de contacto',
            'Cargo',
            'Email',
            'Celular',
            'Instagram',
            'Facebook',
            'Linkedin',
            'Ubicación GPS',
            'Etapa',
            'Completo diagnostico',
            'Completo actualizacion de datos',
        ];
    }
    public function map($model): array {
        return [
            $model->business_name,
            $model->nit,
            $model->name_legal_representative,
            $model->registration_number,
            $model->registration_date,
            $model->registration_email,
            $model->tipoPersona->tipoPersonaNOMBRE ?? null,
            $model->sector()->first()->sectorNOMBRE ?? null,
            $model->tamano()->first()->tamanoNOMBRE ?? null,
            $model->comercial_activity,
            $model->affiliated == 1 ? 'SI' : 'NO',
            $model->departamento()->first()->departamentoNOMBRE ?? null,
            $model->municipio()->first()->municipionombreoficial ?? null,
            $model->address,
            $model->telephone,
            $model->mobile,
            $model->website,
            $model->contact_person,
            $model->contact_position,
            $model->contact_email,
            $model->contact_phone,
            $model->social_instagram,
            $model->social_facebook,
            $model->social_linkedin,
            $model->geolocation,
            $model->etapa()->first()->name ?? null,
            $model->complete_diagnostic == 1 ? 'SI' : 'NO',
            $model->update_info == 1 ? 'SI' : 'NO',
        ];
    }
}
