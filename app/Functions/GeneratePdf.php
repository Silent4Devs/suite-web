<?php

namespace App\Functions;

use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Laracasts\Flash\Flash;

class GeneratePdf
{
    public function Generate($pdfvalue, $datavalues)
    {
        switch ($pdfvalue) {
            case 'PartesInt':
                $cabeceras = ['Parte Interesada', 'Requisitos', 'Cláusula'];
                $file = 'PartesInteresadas-'.$datavalues->id.'-'.$datavalues->created_at->format('d-m-Y').'.pdf';
                $pdf = PDF::loadView('PDF.PDF', compact('cabeceras', 'datavalues', 'pdfvalue'))->save('data/'.$file);
                Storage::disk('Iso27001')->put('Planeación/Partes Interesadas/'.$file, $pdf->output());
                unlink('data/'.$file);
                Flash::success('Información añadida con éxito');
                break;
            case 'accioncorrectiva':
                $file = 'AccionCorrectiva-'.$datavalues->id.'-'.$datavalues->created_at->format('d-m-Y').'.pdf';
                $pdf = PDF::loadView('PDF.accion_correctiva.F_SGI_016_accion_correctiva_v1', compact('pdfvalue', 'datavalues'))->save('data/'.$file);
                Storage::disk('Iso27001')->put('Mejora continua/Acciones Correctivas/'.$file, $pdf->output());
                unlink('data/'.$file);
                Flash::success('Información añadida con éxito');
                break;
            case 'planAuditoria':
                //dd("Entra a plan auditoria", $datavalues);
                $pdf_obj = App::make('dompdf.wrapper');
                $pdf_obj->loadView('PDF.lista_verificacion.lista_verificacion', compact('datavalues'));

                $file = 'planAuditoria-'.$datavalues->id.'-'.$datavalues->created_at->format('d-m-Y').'.pdf';
                $content = $pdf_obj->download()->getOriginalContent();

                Storage::disk('Iso27001')->put('Evaluación/Auditoría Interna/'.$file, $content);
                // unlink("data/" . $file);
                //dd("Termina");
                Flash::success('Información añadida con éxito');
                break;
            default:
                Flash::error('Error, intente de nuevo');
        } //end switch
    }
}
