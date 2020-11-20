<?php


namespace App\Functions;

use App\Models\PartesInteresada;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Storage;
use Laracasts\Flash\Flash;

class GeneratePdf
{
    public function Generate($pdfvalue)
    {
        switch ($pdfvalue) {
            case 'PartesInt':
                $cabeceras = ['Parte Interesada', 'Requisitos', 'Cláusula'];
                $datas = PartesInteresada::all('parteinteresada', 'requisitos', 'clausala');
                $pdf = PDF::loadView('PDF.pdf', compact('cabeceras', 'datas', 'pdfvalue'))->save("data/PartesInteresadas.pdf");
                Storage::disk('Iso27001')->put('Planeación/Partes Interesadas/PartesInteresadas.pdf', $pdf->output());
                unlink("data/PartesInteresadas.pdf");
                Flash::success('Información añadida con éxito');
                break;
            default:
                Flash::error('Error, intente de nuevo');
        }//end switch
    }
}
