<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recepcion extends Model
{
    use HasFactory;

    protected $fillable = [
        'lugar', 'fecha', 'formulario_no', 'aeropuerto', 'hangar',
        'cond_custodio', 'cond_depositario', 'cond_comodato', 'numero_caso',
        'cargo', 'unidad', 'grado_id', 'nombres', 'celular',
        'aeronave_id', 'tipo_aeronave', 'matricula', 'procedencia', 'serie', 'modelo', 'marca',
        'marca_motor', 'modelo_motor', 'marca_helices', 'palas', 'color', 'observaciones',
        'firmado_por', 'cargo_firmante', 'fecha_firma',
    ];

    protected $casts = [
        'fecha' => 'date',
        'fecha_firma' => 'datetime',
        'cond_custodio' => 'boolean',
        'cond_depositario' => 'boolean',
        'cond_comodato' => 'boolean',
    ];

    public function aeronave()
    {
        return $this->belongsTo(Aeronave::class);
    }

    public function grado()
    {
        return $this->belongsTo(Grado::class);
    }

    public function partes()
    {
        return $this->hasMany(RecepcionParte::class);
    }
}
