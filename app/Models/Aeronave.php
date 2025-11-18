<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\Auditable;

class Aeronave extends Model
{
    use HasFactory, SoftDeletes, Auditable;

    protected $fillable = [
        'matricula', 'tipo', 'modelo', 'marca', 'numero_serie', 'numero_parte', 'fabricante_id',
        'estado', 'hangar_id', 'ubicacion_actual', 'documento_legal', 'documento',
        'horas_vuelo_total', 'horas_desde_mantenimiento', 'mantenimiento_cada_horas', 'fecha_ultimo_mantenimiento',
    ];
     

    

    protected $casts = [
            'fecha_ultimo_mantenimiento' => 'date',
            'horas_vuelo_total' => 'decimal:1',
            'horas_desde_mantenimiento' => 'decimal:1',
            'mantenimiento_pendiente' => 'boolean', // Cast existente
        ];

    public function getHorasRestantesParaMantenimientoAttribute(): float
    {
        $intervalo = (int) ($this->mantenimiento_cada_horas ?? 50);
        $desde = (float) ($this->horas_desde_mantenimiento ?? 0);
        $restantes = $intervalo - $desde;
        return $restantes > 0 ? $restantes : 0.0;
    }

    public function getUltimaAccionAttribute()
    {
        $log = AuditLog::where('model_type', self::class)
            ->where('model_id', $this->id)
            ->latest('created_at')
            ->first();

        if ($log) {
            $usuario = $log->user->name ?? 'Desconocido';
            return ucfirst($log->action) . ' por ' . $usuario;
        }

        return 'Sin acciones registradas';
    }
    
    public function getMantenimientoVencidoAttribute(): bool
    {
        $intervalo = (int) ($this->mantenimiento_cada_horas ?? 50);
        $desde = (float) ($this->horas_desde_mantenimiento ?? 0);
        return $desde >= $intervalo;
    }

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

    /*
    |--------------------------------------------------------------------------
    | Mutators: normalización de enums desde textos variados (importaciones)
    |--------------------------------------------------------------------------
    */
    public function setTipoAttribute($value): void
    {
        if ($value === null) { $this->attributes['tipo'] = null; return; }
        $v = strtolower(trim($value));
        // Normalizar a enum de BD: 'ala fija' | 'ala rotatoria'
        if (str_contains($v, 'heli') || str_contains($v, 'raven') || str_contains($v, 'helcop') || str_contains($v, 'rotatoria')) {
            $this->attributes['tipo'] = 'ala rotatoria';
            return;
        }
        if (str_contains($v, 'avion') || str_contains($v, 'avión') || str_contains($v, 'avioneta') || str_contains($v, 'cessna') || str_contains($v, 'fija')) {
            $this->attributes['tipo'] = 'ala fija';
            return;
        }
        // Si no coincide, guardar null (columna es nullable) para evitar truncation.
        $this->attributes['tipo'] = null;
    }

    public function setMarcaAttribute($value): void
    {
        if ($value === null) { $this->attributes['marca'] = null; return; }
        $v = strtolower(trim($value));
        $map = [
            'cessna' => 'cessna',
            'piper' => 'piper',
            'pipp' => 'piper',
            'beech' => 'beechcraft',
            'beechcraft' => 'beechcraft',
            'airbus' => 'airbus',
            'boeing' => 'boeing',
            'embraer' => 'embraer',
            'bombardier' => 'bombardier',
            'bell' => 'bell',
            'robinson' => 'robinson',
            'sikorsky' => 'sikorsky',
            'diamond' => 'diamond',
            'cirrus' => 'cirrus',
            'tecnam' => 'tecnam',
        ];
        foreach ($map as $needle => $normalized) {
            if (str_contains($v, $needle)) {
                $this->attributes['marca'] = $normalized;
                return;
            }
        }
        $this->attributes['marca'] = 'otro';
    }

    public function setEstadoAttribute($value): void
    {
        if ($value === null) { $this->attributes['estado'] = 'activo'; return; }
        $v = strtolower(trim($value));
        if (str_contains($v, 'manten')) {
            $this->attributes['estado'] = 'mantenimiento';
            return;
        }
        if (str_contains($v, 'inoper') || str_contains($v, 'precint') || str_contains($v,'sinies')) {
            $this->attributes['estado'] = 'inactivo';
            return;
        }
        $this->attributes['estado'] = 'activo';
    }
}
