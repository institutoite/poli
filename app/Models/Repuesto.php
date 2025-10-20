<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repuesto extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_parte', 'numero_serie', 'descripcion', 'fabricante', 'cantidad', 'condicion',
        'ubicacion_actual', 'fecha_ingreso', 'documento_legal',
    ];

    protected $casts = [
        'fecha_ingreso' => 'date',
    ];
}
