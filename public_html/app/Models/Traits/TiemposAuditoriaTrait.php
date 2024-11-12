<?php
namespace App\Models\Traits;

trait TiemposAuditoriaTrait
{
   
    public function getCreatedAtColumn()
    {
        return 'fecha_creacion';
    }

    public function getUpdatedAtColumn()
    {
        return 'fecha_actualizacion';
    }

    public function getAuditDeletedAtColumn()
    {
        return 'fecha_eliminacion';
    }
}

?>