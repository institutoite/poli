<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Study extends Model
{
    use HasFactory;

    protected $fillable = [
        'police_officer_id',
        'unidad_educativa_bachillerato',
        'fecha_graduacion_secundaria',
        'municipio_egreso_secundaria',
        'titulo_bachiller',
        'numero_semestres_aprobados',
        'institucion_formacion',
        'titulo_profesional',
        'fecha_graduacion_universitaria',
        'departamento_egreso',
    ];

    protected $casts = [
        'fecha_graduacion_secundaria' => 'date',
        'fecha_graduacion_universitaria' => 'date',
    ];

    public function policeOfficer(): BelongsTo
    {
        return $this->belongsTo(PoliceOfficer::class);
    }
}
