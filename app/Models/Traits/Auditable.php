<?php

namespace App\Models\Traits;

use App\Models\AuditLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

trait Auditable
{
    public static function bootAuditable()
    {
        static::created(function (Model $model) {
            $model->guardarAuditoria('creado');
        });

        static::updated(function (Model $model) {
            $model->guardarAuditoria('actualizado');
        });

        static::deleted(function (Model $model) {
            $model->guardarAuditoria('eliminado');
        });

        static::restored(function (Model $model) {
            $model->guardarAuditoria('restaurado');
        });
    }

    protected function guardarAuditoria(string $accion)
    {
        AuditLog::create([
            'user_id' => 1,
            'model_type' => static::class, // Clase del modelo afectado
            'model_id' => $this->getKey(), // ID del modelo afectado
            'action' => $accion, // Acción realizada
            'changes' => $accion === 'updated' ? $this->getChanges() : null, // Cambios realizados
            'deleted_at' => $accion === 'deleted' ? now() : null, // Fecha de eliminación lógica
        ]);
    }
}
