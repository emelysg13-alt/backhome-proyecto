<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Seguimiento;

class PdfController extends Controller
{
    public function descargar()
    {
        $seguimientos = Seguimiento::all();

        $pdf = Pdf::loadView(
            'pdf.reportes',
            compact('seguimientos')
        );

        return $pdf->download('reportes_animales.pdf');
    }
}