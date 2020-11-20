<?php


namespace App\Functions;

use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Storage;

class GeneratePdf
{
    public function Generate($pdfvalue, $Data)
    {
        //dd($pdfvalue, $Data);
        switch ($pdfvalue) {
            case 'PartesInt':
                $pdf = PDF::loadView('PDF.pdf', compact('Data'))->save("data/PartesInteresadas.pdf");
                //Storage::disk("AnalisisInicial")->move("data/PartesInteresadas.pdf","PartesInteresadas.pdf");
                Storage::disk('Iso27001')->put('Analísis Inicial/Cuestionarios de Evaluación/PartesInteresadas.pdf', $pdf->output());
                dd("Termino");
            //return $pdf->download('invoice.pdf');
        }//end switch
    }
}
