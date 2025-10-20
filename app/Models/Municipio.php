<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Municipio extends Model
{
    use HasFactory;

    protected $fillable = ['provincia_id', 'nombre', 'codigo'];

    public function provincia(): BelongsTo
    {
        return $this->belongsTo(Provincia::class);
    }
}
