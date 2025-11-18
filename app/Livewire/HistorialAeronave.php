<?php
// app/Http/Livewire/HistorialAeronave.php

namespace App\Http\Livewire;

use App\Models\AuditLog;
use Livewire\Component;

class HistorialAeronave extends Component
{
    public $aeronaveId;
    public $historial = [];

    protected $listeners = ['abrirHistorial' => 'cargarHistorial'];

    public function cargarHistorial($aeronaveId)
    {
        $this->aeronaveId = $aeronaveId;

        $this->historial = AuditLog::where('model_type', 'App\Models\Aeronave')
            ->where('model_id', $aeronaveId)
            ->orderBy('created_at', 'desc')
            ->get()
            ->toArray();

        $this->dispatchBrowserEvent('mostrarModal');
    }

    public function render()
    {
        return view('livewire.historial-aeronave');
    }
}
