<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hangar extends Model
{
    use HasFactory;

    // La tabla se llama 'hangares' (no 'hangars')
    protected $table = 'hangares';

    protected $fillable = [
        'nombre', 'codigo', 'ubicacion',
    ];

    public function aeronaves()
    {
        return $this->hasMany(Aeronave::class);
    }
}
