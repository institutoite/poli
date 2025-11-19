<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Aeronave;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function exportarPDF()
    {
        $aeronaves = Aeronave::all();

        $pdf = Pdf::loadView('exports.aeronaves', compact('aeronaves'));

        return $pdf->download('reporte_aeronaves.pdf');
    }
}
