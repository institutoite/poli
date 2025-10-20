<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Zona extends Model
{
    use HasFactory;

    protected $fillable = ['municipio_id', 'nombre'];

    public function municipio(): BelongsTo
    {
        return $this->belongsTo(Municipio::class);
    }

    public function barrios(): HasMany
    {
        return $this->hasMany(Barrio::class);
    }
}
