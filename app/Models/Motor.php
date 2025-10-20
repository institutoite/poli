<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motor extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_serie', 'numero_parte', 'tipo_modelo', 'fabricante', 'aeronave_id', 'estado',
        'ubicacion_actual', 'fecha_ingreso', 'documento_legal',
    ];

    protected $casts = [
        'fecha_ingreso' => 'date',
    ];

    public function aeronave()
    {
        return $this->belongsTo(Aeronave::class);
    }
}
