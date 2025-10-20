<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecepcionParte extends Model
{
    use HasFactory;

    protected $fillable = [
        'recepcion_id', 'ambito', 'descripcion', 'cantidad', 'estado', 'observaciones',
    ];

    public function recepcion()
    {
        return $this->belongsTo(Recepcion::class);
    }
}
