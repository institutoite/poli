<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Idioma extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'codigo_iso'];

    public function policeOfficers(): BelongsToMany
    {
        return $this->belongsToMany(PoliceOfficer::class, 'idioma_police_officer');
    }
}
