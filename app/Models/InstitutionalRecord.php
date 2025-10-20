<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InstitutionalRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'police_officer_id',
        'fecha_ingreso_institucion',
        'direccion_policial',
        'fecha_destino_direccion',
        'direccion_policial_procedente',
        'unidad_o_direccion_actual',
        'fecha_alta_nueva_unidad',
        'numero_memorial_alta',
        'fecha_cambio_destino',
        'memorandum_cambio_destino',
        'anios_servicio',
    ];

    protected $casts = [
        'fecha_ingreso_institucion' => 'date',
        'fecha_destino_direccion' => 'date',
        'fecha_alta_nueva_unidad' => 'date',
        'fecha_cambio_destino' => 'date',
    ];

    public function policeOfficer(): BelongsTo
    {
        return $this->belongsTo(PoliceOfficer::class);
    }
}
