<?php
namespace App\Traits;

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

    public function getDeletedAtColumn()
    {
        return 'fecha_eliminacion';
    }
}

?>
