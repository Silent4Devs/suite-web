<?php


namespace App\Functions;

use App\Models\PartesInteresada;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Storage;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\DB;

class GeneratePdf
{
    public function Generate($pdfvalue, $datavalues)
    {
        switch ($pdfvalue) {
            case 'PartesInt':
                $cabeceras = ['Parte Interesada', 'Requisitos', 'Cláusula'];
                $file = 'PartesInteresadas-'.$datavalues->id.'-'.$datavalues->created_at.'.pdf';
                $pdf = PDF::loadView('PDF.PDF', compact('cabeceras', 'datavalues', 'pdfvalue'))->save("data/".$file);
                Storage::disk('Iso27001')->put('Planeación/Partes Interesadas/'.$file, $pdf->output());
                unlink("data/".$file);
                Flash::success('Información añadida con éxito');
                break;
            case 'accioncorrectiva':
                $file = 'AccionCorrectiva-'.$datavalues->id.'-'.$datavalues->created_at.'.pdf';
                $pdf = PDF::loadView('PDF.accion_correctiva.F_SGI_016_accion_correctiva_v1', compact('pdfvalue', 'datavalues'))->save("data/".$file);
                Storage::disk('Iso27001')->put('Mejora continua/Acciones Correctivas/'.$file, $pdf->output());
                unlink("data/".$file);
                Flash::success('Información añadida con éxito');
                break;
            case 'planAuditoria':
                $file = 'planAuditoria-'.$datavalues->id.'-'.$datavalues->created_at.'.pdf';
                //dd("Entra a plan auditoria", $datavalues);
                $pdf = PDF::loadView('PDF.lista_verificacion.lista_verificacion', compact( 'datavalues'))->save("data/".$file);
                Storage::disk('Iso27001')->put('Evaluación/Auditoría Interna/'.$file, $pdf->output());
                unlink("data/".$file);
                //dd("Termina");
                Flash::success('Información añadida con éxito');
                break;
            default:
                Flash::error('Error, intente de nuevo');
        }//end switch
    }
}
