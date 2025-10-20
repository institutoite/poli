<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PoliceOfficer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nombres',
        'apellido_paterno',
        'apellido_materno',
        'documento_identidad',
        'expedido_documento',
        'codigo_escalafon',
        'nacionalidad_id',
        'direccion',
        'telefono',
        'celular',
        'genero',
        'fecha_nacimiento',
        'grado_id',
        'categoria_licencia_conducir',
        'cuenta_bancaria',
        'banco_id',
        'croquis_domicilio',
        'coordenada_x',
        'coordenada_y',
        'departamento_id',
        'provincia_id',
        'municipio_id',
        'zona_id',
        'barrio_id',
        'correo',
        'grupo_factor_sangre',
        'contacto_emergencia',
        'telefono_emergencia',
        'parentesco_contacto_emergencia',
    ];

    protected $casts = [
        'fecha_nacimiento' => 'date',
        'coordenada_x' => 'decimal:7',
        'coordenada_y' => 'decimal:7',
    ];

    public function studies(): HasMany
    {
        return $this->hasMany(Study::class);
    }

    public function institutionalRecords(): HasMany
    {
        return $this->hasMany(InstitutionalRecord::class);
    }

    public function nacionalidad(): BelongsTo
    {
        return $this->belongsTo(Nacionalidad::class);
    }

    public function grado(): BelongsTo
    {
        return $this->belongsTo(Grado::class);
    }

    public function banco(): BelongsTo
    {
        return $this->belongsTo(Banco::class);
    }

    public function departamento(): BelongsTo
    {
        return $this->belongsTo(Departamento::class);
    }

    public function provincia(): BelongsTo
    {
        return $this->belongsTo(Provincia::class);
    }

    public function municipio(): BelongsTo
    {
        return $this->belongsTo(Municipio::class);
    }

    public function zona(): BelongsTo
    {
        return $this->belongsTo(Zona::class);
    }

    public function barrio(): BelongsTo
    {
        return $this->belongsTo(Barrio::class);
    }

    public function idiomas(): BelongsToMany
    {
        return $this->belongsToMany(Idioma::class, 'idioma_police_officer');
    }
}
