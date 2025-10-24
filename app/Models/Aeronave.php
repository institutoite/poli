<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aeronave extends Model
{
    use HasFactory;

    protected $fillable = [
        'matricula', 'tipo', 'modelo', 'marca', 'numero_serie', 'numero_parte', 'fabricante_id',
        'estado', 'hangar_id', 'ubicacion_actual', 'documento_legal',
    ];

    public function motores()
    {
        return $this->hasMany(Motor::class);
    }

    public function recepciones()
    {
        return $this->hasMany(Recepcion::class);
    }

    public function fabricante()
    {
        return $this->belongsTo(Fabricante::class);
    }

    public function hangar()
    {
        return $this->belongsTo(Hangar::class);
    }
}
