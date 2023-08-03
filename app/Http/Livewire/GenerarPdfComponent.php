<?php

namespace App\Http\Livewire;

use App\Models\ControlDocumento;
use App\Models\EntendimientoOrganizacion;
use App\Models\MatrizRequisitoLegale;
use App\Models\PartesInteresada;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use PhpOffice\PhpWord\Shared\Html;
// require_once "vendor/autoload.php";

use PhpOffice\PhpWord\SimpleType\DocProtect;
use PhpOffice\PhpWord\SimpleType\Jc;
use PhpOffice\PhpWord\Style\Language;
use PhpOffice\PhpWord\Style\TOC;

class GenerarPdfComponent extends Component
{
    const NUEVA_LINEA = '</w:t><w:br/><w:t>';

    const PASSWORD_WORD = '12345678';

    public $nombre_documento;

    public function mount($nombre_control_documento)
    {
        $this->nombre_documento = $nombre_control_documento;
    }

    public function render()
    {
        return view('livewire.generar-pdf-component');
    }

    public function generarDocumento($valor = 'contexto')
    {
        $organizacion = DB::table('organizacions')
            ->select('logotipo', 'empresa', 'antecedentes', 'direccion', 'telefono', 'pagina_web', 'giro', 'servicios', 'mision', 'vision', 'valores', 'correo')
            ->first();
        $logotipo = '';
        if (isset($organizacion)) {
            if ($organizacion->logotipo != null) {
                $logotipo = 'images/'.$organizacion->logotipo;
            } else {
                $logotipo = 'img/Silent4Business-Logo-Color.png';
            }
        } else {
            $logotipo = 'img/Silent4Business-Logo-Color.png';
        }

        if (! $organizacion) {
            $this->emit('showErrorAlert', 'Aún no has registrado tu organización');

            return response()->noContent();
        }

        $matriz_requisitos_legales = MatrizRequisitoLegale::get();
        $foda = EntendimientoOrganizacion::first();
        if (! $foda) {
            $this->emit('showErrorAlert', 'Aún no has realizado en análisis FODA');

            return response()->noContent();
        }

        $partes_interesadas = PartesInteresada::get();

        switch ($valor) {
            case 'Contexto de la organización':
                $control_documento = ControlDocumento::where('nombre', '=', 'Contexto de la organización')->first();
                if (! $control_documento) {
                    $this->emit('showErrorAlert', 'No existe el control de documento:'.$control_documento->nombre);

                    return response()->noContent();
                } else {
                    if (is_null($control_documento->clave) || is_null($control_documento->fecha_creacion) || is_null($control_documento->elaboro_id) || is_null($control_documento->reviso_id)) {
                        $this->emit('showErrorAlert', 'Tienes que llenar los campos faltantes del control de documento: '.$control_documento->nombre);

                        return response()->noContent();
                    }
                    $control_documento->update([
                        'version' => $control_documento->version + 1,
                        'estado_id' => 4,
                    ]);
                    $file = 'Contexto de la organización v'.$control_documento->version.'.pdf';

                    $pdf = App::make('dompdf.wrapper');
                    $pdf->loadView('PDF.contexto.contexto', compact('control_documento', 'logotipo', 'organizacion', 'matriz_requisitos_legales', 'foda', 'partes_interesadas', 'pdf'));
                    $content = $pdf->download()->getOriginalContent();
                    Storage::disk('Iso27001')->put('/'.$file, $content);
                    $filename = 'Contexto de la organización v'.$control_documento->version.'.docx';
                    $this->generarWord('contexto', $filename, $organizacion, $logotipo, $matriz_requisitos_legales, $foda, $partes_interesadas, $control_documento);

                    $this->emit('showSuccessAlert', 'Documento PDF y Word generados con éxito');
                }
                break;
            case 'Test':
                $control_documento = ControlDocumento::where('nombre', '=', 'Test')->first();
                $this->emit('showSuccessAlert', 'En construcción');
                break;
            default:
                $this->emit('showErrorAlert', 'Algo salió, no existe el control de documento con el nombre: '.$this->nombre_documento);
                break;
        }

        return response()->noContent();
    }

    public function generarWord($valor, $file_name, $organizacion, $logotipo, $matriz_requisitos_legales, $foda, $partes_interesadas, $control_documento)
    {
        switch ($valor) {
            case 'contexto':
                $control_documento = ControlDocumento::where('nombre', '=', 'Contexto de la organización')->first();
                if (! $control_documento) {
                    session()->flash('error_control_documento', 'No existe el control de documento: Contexto de la organización');

                    return response()->noContent();
                } else {
                    $documento = $this->generarEstudioContexto($file_name, $organizacion, $logotipo, $matriz_requisitos_legales, $foda, $partes_interesadas, $control_documento);
                    $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($documento, 'Word2007');
                    $objWriter->save(storage_path('app/public/Normas/ISO27001/').$file_name);
                    // session()->flash('success', 'Archivo Word Generado con éxito');
                    $this->emit('showSuccessAlert', 'Archivo Word Generado con éxito');
                }
                break;
            default:
                session()->flash('error_general', 'Algo salió mal al generar el archivo Word, intenta nuevamente.');
                break;
        }

        return response()->noContent();
    }

    public function generarEstudioContexto($filename, $organizacion, $logotipo, $matriz_requisitos_legales, $foda, $partes_interesadas, $control_documento)
    {
        // $control_documento = ControlDocumento::where('nombre', '=', 'Contexto de la organización')->first();
        // if (!$control_documento) {
        //     session()->flash('error_control_documento', 'No existe el control de documento: Contexto de la organización');
        //     return response()->noContent();
        // }

        $texto_encabezado = $control_documento->clave.self::NUEVA_LINEA.self::NUEVA_LINEA.'Versión: '
            .$control_documento->version.self::NUEVA_LINEA.self::NUEVA_LINEA.
            Carbon::now()->format('d-m-Y');

        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $documentProtection = $phpWord->getSettings()->getDocumentProtection();
        $documentProtection->setEditing(DocProtect::READ_ONLY);
        $documentProtection->setPassword(self::PASSWORD_WORD);
        //$phpWord->getSettings()->setUpdateFields(true);
        $propiedades = $phpWord->getDocInfo();
        $propiedades->setCreator($organizacion->empresa);
        $propiedades->setTitle('Estudio de Contexto');

        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        header('Content-Disposition: attachment; filename='.$filename);

        $texto_negrita = ['bold' => true, 'color' => '000000'];
        $texto_alinear_centro = ['alignment' => Jc::CENTER];
        $texto_justificado = ['alignment' => Jc::BOTH];

        $fuenteTitulo = [
            'name' => 'Arial',
            'size' => 16,
            'color' => '4472C4',
        ];

        $fuenteSubtitulo = [
            'name' => 'Arial',
            'size' => 14,
            'color' => '1F3763',
        ];

        $encabezado_tabla = [
            'bgColor' => '000000',
        ];

        $secundario_tabla = [
            'bgColor' => 'D9D9D9',
        ];
        $cellRowContinue = ['vMerge' => 'continue'];

        $section = $phpWord->addSection();
        //$section->getStyle()->setPageNumberingStart(1);
        $header = $section->addHeader();
        $tableStyle = [
            'borderColor' => '000000',
            'borderSize' => '5',
            'cellMargin' => '20',
        ];

        $phpWord->addTableStyle('encabezado_table', $tableStyle);
        $table = $header->addTable('encabezado_table');
        $table->addRow();
        $table->addCell(4000)->addImage(public_path($logotipo), [
            'width' => 70,
            'alignment' => JC::CENTER,
            'valign' => 'center',
        ]);

        $table->addCell(8000, [
            'valign' => 'center',
        ])->addText('Estudio de Contexto', $texto_negrita, $texto_alinear_centro);
        $table->addCell(4000, [
            'valign' => 'center',
        ])->addText($texto_encabezado, $texto_negrita, $texto_alinear_centro);

        $footer = $section->addFooter();
        $footer->addPreserveText('Página {PAGE} de {NUMPAGES}.');

        $phpWord->addTitleStyle(1, $fuenteTitulo);
        $phpWord->addTitleStyle(2, $fuenteSubtitulo);
        // Agregar el título del índice
        $section->addTitle('Contenido', 1);
        // Aquí agregamos la tabla de contenidos
        $fuenteTablaContenidos = [
            'name' => 'Arial',
            'size' => 11,
            'color' => '000000',
        ];
        $estiloTablaDeContenidos = [
            'tabLeader' => TOC::TABLEADER_LINE,
        ];
        $section->addTOC($fuenteTablaContenidos, $estiloTablaDeContenidos);

        // INTRODUCCION
        $section->addPageBreak();
        $section->addTitle('Introducción', 1);
        $texto_introduccion = $organizacion->empresa.' determinará a través de este documento las cuestiones externas e internas que son pertinentes para su propósito y que afectan su capacidad para lograr los resultados previstos de su Sistema de Gestión de Seguridad de la Información (SGSI) para entender su contexto en las dos perspectivas mencionadas.';
        $section->addText($texto_introduccion, null, $texto_justificado);

        //OBJETIVO
        $section->addTextBreak(1);
        $section->addTitle('Objetivo', 1);
        $texto_objetivo = 'Establecer en'.$organizacion->empresa.' el contexto del SGSI en cumplimiento de los requisitos de la norma ISO 27001 recogidos en la cláusula 4 de la Norma.';
        $section->addText($texto_objetivo, null, $texto_justificado);

        // DEFINICIONES
        $section->addTextBreak(1);
        $section->addTitle('Definiciones', 1);
        $phpWord->addTableStyle('tabla_definiciones', $tableStyle, $encabezado_tabla);
        $table_definiciones = $section->addTable('tabla_definiciones');
        $table_definiciones->addRow();
        $table_definiciones->addCell(4000)->addText('Concepto');
        $table_definiciones->addCell(10000)->addText('Definición');
        $table_definiciones->addRow();
        $table_definiciones->addCell(4000, $secundario_tabla)->addText('Alcance');
        $table_definiciones->addCell(10000)->addText('Ámbito de la organización que queda sometido al SGSI.', null, $texto_justificado);
        $table_definiciones->addRow();
        $table_definiciones->addCell(4000, $secundario_tabla)->addText('Contexto interno');
        $table_definiciones->addCell(10000)->addText('Entorno interno en el que la organización busca alcanzar sus objetivos.', null, $texto_justificado);
        $table_definiciones->addRow();
        $table_definiciones->addCell(4000, $secundario_tabla)->addText('Contexto Externo');
        $contexto_externo_it = $table_definiciones->addCell(10000);
        $contexto_externo_it
            ->addText('Entorno externo en el que la organización busca alcanzar sus objetivos.'.self::NUEVA_LINEA.'
                                                 El contexto externo puede incluir:', null, $texto_justificado);
        $contexto_externo_it->addListItem('El entorno cultural, social, político, jurídico, reglamentario, financiero, tecnológico, económico, natural y competitivo, ya sea internacional, nacional, regional o local.');
        $contexto_externo_it->addListItem('Influencias y tendencias clave que tienen impacto en los objetivos de la organización.');
        $contexto_externo_it->addListItem('Los valores de actores externos y como es percibida la organización (sus relaciones con el entorno externo).');

        $table_definiciones->addRow();
        $table_definiciones->addCell(4000, $secundario_tabla)->addText('FODA');
        $table_definiciones->addCell(10000)->addText('Metodología donde se conforma un cuadro de la situación actual de la organización permitiendo de esta manera obtener un diagnóstico preciso para tomar decisiones (estrategias) que favorezcan el posicionamiento de este. El análisis FODA está compuesto por una evaluación de las competencias internas como fortalezas (F), debilidades (D), y las competencias externas como las oportunidades (O) y amenazas (A), dónde nos proporciona un esquema para la toma de decisiones estratégicas.', null, $texto_justificado);
        $table_definiciones->addRow();
        $table_definiciones->addCell(4000, $secundario_tabla)->addText('ISO 27001');
        $table_definiciones->addCell(10000)->addText('ISO 27001 es una norma desarrollada por ISO (organización internacional de Normalización) con el propósito de ayudar a gestionar la Seguridad de la Información en una empresa. La nomenclatura exacta de la Norma actual es ISO/IEC 27001 que es la revisión de la norma en su primera versión que fue publicada en el año 2005 como una adaptación de ISO de la norma británica BS 7799-2', null, $texto_justificado);
        $table_definiciones->addRow();
        $table_definiciones->addCell(4000, $secundario_tabla)->addText('Misión');
        $table_definiciones->addCell(10000)->addText('Es una declaración escrita en la que se describe la razón de ser de la empresa y su objetivo principal. Es una declaración de los principios corporativos y debe redactarse expresamente para cada empresa u organización.', null, $texto_justificado);
        $table_definiciones->addRow();
        $table_definiciones->addCell(4000, $secundario_tabla)->addText('Organización');
        $table_definiciones->addCell(10000)->addText('Persona o grupo de personas que tiene sus propias funciones con responsabilidades, autoridades y relaciones para lograr sus objetivos.', null, $texto_justificado);
        $table_definiciones->addRow();
        $table_definiciones->addCell(4000, $secundario_tabla)->addText('Parte interesada');
        $table_definiciones->addCell(10000)->addText('Persona u organización que puede afectar, verse afectada o percibirse como afectada por una decisión o actividad.', null, $texto_justificado);
        $table_definiciones->addRow();
        $table_definiciones->addCell(4000, $secundario_tabla)->addText('Requisitos');
        $table_definiciones->addCell(10000)->addText('Necesidad o expectativa que se declara, generalmente implícita u obligatoria. "Generalmente implícito" significa que es una práctica habitual o común para la organización y las partes interesadas que la necesidad o expectativa en cuestión esté implícita. Un requisito especificado es uno que se establece, por ejemplo, en la necesidad de contar con información documentada.', null, $texto_justificado);
        $table_definiciones->addRow();
        $table_definiciones->addCell(4000, $secundario_tabla)->addText('Seguridad de la Información');
        $table_definiciones->addCell(10000)->addText('Preservación de la confidencialidad, integridad y disponibilidad de la información. Además, hay que considerar otras propiedades, como la autenticidad, la responsabilidad, el no repudio y la confiabilidad también pueden estar involucrados.', null, $texto_justificado);
        $table_definiciones->addRow();
        $table_definiciones->addCell(4000, $secundario_tabla)->addText('Sistema de Gestión de Seguridad de la Información');
        $table_definiciones->addCell(10000)->addText('Un sistema de gestión para la Seguridad de la información se compone de una serie de procesos para implementar, mantener y mejorar de forma continua la seguridad de la información tomando como base los riesgos que afectan a la seguridad de la información en una empresa u organización', null, $texto_justificado);
        $table_definiciones->addRow();
        $table_definiciones->addCell(4000, $secundario_tabla)->addText('Visión');
        $table_definiciones->addCell(10000)->addText('Describe el objetivo que espera lograr una empresa en un futuro.', null, $texto_justificado);

        // SOBRE LA EMPRESA
        $section->addTextBreak(1);
        $section->addTitle('Sobre la empresa', 1);
        $section->addTitle('Generales', 2);
        $phpWord->addTableStyle('tabla_generales', $tableStyle, $encabezado_tabla);
        $table_generales = $section->addTable('tabla_generales');
        $table_generales->addRow();
        $table_generales->addCell(null, ['gridSpan' => 2, 'valign' => 'center'])->addText('DATOS GENERALES', null, $texto_alinear_centro);
        $table_generales->addRow();
        $table_generales->addCell(5000, $secundario_tabla)->addText('Nombre de la Empresa');
        $table_generales->addCell(9000)->addText($organizacion->empresa, null, $texto_justificado);
        $table_generales->addRow();
        $table_generales->addCell(5000, $secundario_tabla)->addText('Dirección');
        $table_generales->addCell(9000)->addText($organizacion->direccion, null, $texto_justificado);
        $table_generales->addRow();
        $table_generales->addCell(5000, $secundario_tabla)->addText('Teléfono(s)');
        $table_generales->addCell(9000)->addText($organizacion->telefono, null, $texto_justificado);
        $table_generales->addRow();
        $table_generales->addCell(5000, $secundario_tabla)->addText('Página Web');
        $table_generales->addCell(9000)->addText($organizacion->pagina_web, null, $texto_justificado);
        $table_generales->addRow();
        $table_generales->addCell(5000, $secundario_tabla)->addText('Giro');
        $table_generales->addCell(9000)->addText($organizacion->giro, null, $texto_justificado);
        $table_generales->addRow();
        $table_generales->addCell(5000, $secundario_tabla)->addText('Productos o Servicios');
        $table_generales->addCell(9000)->addText($organizacion->servicios, null, $texto_justificado);

        $section->addTitle('Antecedentes', 2);
        $section->addText('En este apartado describiremos los antecedentes de '.$organizacion->empresa, null, $texto_justificado);
        $section->addText($organizacion->antecedentes, null, $texto_justificado);
        $section->addTitle('Misión', 2);
        $section->addText($organizacion->mision, null, $texto_justificado);
        $section->addTitle('Visión', 2);
        $section->addText($organizacion->vision, null, $texto_justificado);

        // MARCO LEGAL Y REGULATORIO
        $section->addTextBreak(1);
        $section->addTitle('Marco Legal y Regulatorio', 1);
        $section->addText('A continuación, se enlistan los requisitos legales, regulatorios y de otros tipos aplicables para establecer, implantar y mantener el SGSI en '.$organizacion->empresa, null, $texto_justificado);
        $phpWord->addTableStyle('tabla_marco_legal', $tableStyle, $encabezado_tabla);
        $table_marco_legal = $section->addTable('tabla_marco_legal');
        $table_marco_legal->addRow();
        $table_marco_legal->addCell(14000, ['gridSpan' => 9, 'valign' => 'center'])->addText('MATRIZ DE REQUISITOS LEGALES Y REGULATORIOS', null, $texto_alinear_centro);
        $table_marco_legal->addRow();
        $table_marco_legal->addCell(null, $secundario_tabla)->addText('No.');
        $table_marco_legal->addCell(null, $secundario_tabla)->addText('Nombre');
        $table_marco_legal->addCell(null, $secundario_tabla)->addText('Fecha de expedición');
        $table_marco_legal->addCell(null, $secundario_tabla)->addText('Fecha de entrada en vigor');
        $table_marco_legal->addCell(null, $secundario_tabla)->addText('Determinación del requisito a cumplir');
        $table_marco_legal->addCell(null, $secundario_tabla)->addText('¿Se cumple con el requisito?');
        $table_marco_legal->addCell(null, $secundario_tabla)->addText('¿De qué forma se cumple?');
        $table_marco_legal->addCell(null, $secundario_tabla)->addText('Periodicidad de Cumplimiento');
        $table_marco_legal->addCell(null, $secundario_tabla)->addText('Fecha de Verificación');
        if ($matriz_requisitos_legales) {
            foreach ($matriz_requisitos_legales as $index => $requisito_legal) {
                $table_marco_legal->addRow();
                $table_marco_legal->addCell(null)->addText($index + 1);
                $table_marco_legal->addCell(null)->addText($requisito_legal->nombrerequisito);
                $table_marco_legal->addCell(null)->addText($requisito_legal->fechaexpedicion);
                $table_marco_legal->addCell(null)->addText($requisito_legal->fechavigor);
                $table_marco_legal->addCell(null)->addText($requisito_legal->requisitoacumplir);
                $table_marco_legal->addCell(null)->addText($requisito_legal->cumplerequisito);
                $table_marco_legal->addCell(null)->addText($requisito_legal->formacumple);
                $table_marco_legal->addCell(null)->addText($requisito_legal->periodicidad_cumplimiento);
                $table_marco_legal->addCell(null)->addText($requisito_legal->fechaverificacion);
            }
        } else {
            $table_marco_legal->addRow();
            $table_marco_legal->addCell(null)->addText('');
            $table_marco_legal->addCell(null)->addText('');
            $table_marco_legal->addCell(null)->addText('');
            $table_marco_legal->addCell(null)->addText('');
            $table_marco_legal->addCell(null)->addText('');
            $table_marco_legal->addCell(null)->addText('');
            $table_marco_legal->addCell(null)->addText('');
            $table_marco_legal->addCell(null)->addText('');
            $table_marco_legal->addCell(null)->addText('');
        }

        // Factores Internos y Externos
        $section->addTextBreak(1);
        $section->addTitle('Factores Internos y Externos', 1);
        $section->addText($organizacion->empresa.' determina las cuestiones externas e internas que son pertinentes para su propósito y que afectan su capacidad para lograr los resultados previstos en su Sistema de Gestión de Seguridad de la Información (SGSI). Para este fin se emplea la metodología FODA.', null, $texto_justificado);
        $phpWord->addTableStyle('tabla_foda', $tableStyle);
        $table_foda = $section->addTable('tabla_foda');
        $table_foda->addRow();
        $table_foda->addCell(1000)->addText('');
        $table_foda->addCell(7000, $secundario_tabla)->addText('FORTALEZAS', $texto_negrita);
        $table_foda->addCell(7000, $secundario_tabla)->addText('DEBILIDADES', $texto_negrita);
        $table_foda->addRow();
        $table_foda->addCell(1000, $secundario_tabla)->addText('ORIGEN INTERNO');
        $fortalezas = $table_foda->addCell(7000);
        Html::addHtml($fortalezas, preg_replace("/\t/", '', preg_replace("/\r|\n/", '', $foda->fortalezas))); //Se eliminan tabs,return,nueva linea de los tag html
        $debilidades = $table_foda->addCell(7000);
        Html::addHtml($debilidades, preg_replace("/\t/", '', preg_replace("/\r|\n/", '', $foda->debilidades)));
        $table_foda->addRow();
        $table_foda->addCell(1000)->addText('');
        $table_foda->addCell(7000, $secundario_tabla)->addText('OPORTUNIDADES', $texto_negrita);
        $table_foda->addCell(7000, $secundario_tabla)->addText('AMENAZAS', $texto_negrita);
        $table_foda->addRow();
        $table_foda->addCell(1000, $secundario_tabla)->addText('ORIGEN EXTERNO');
        $oportunidades = $table_foda->addCell(7000);
        Html::addHtml($oportunidades, preg_replace("/\t/", '', preg_replace("/\r|\n/", '', $foda->oportunidades)));
        $amenazas = $table_foda->addCell(7000);
        Html::addHtml($amenazas, preg_replace("/\t/", '', preg_replace("/\r|\n/", '', $foda->amenazas)));

        // Determinación de las partes interesadas
        $section->addTextBreak(1);
        $section->addTitle('Determinación de las partes interesadas', 1);
        $section->addText($organizacion->empresa.' determina las partes interesadas que son relevantes para el SGSI, tomando en cuenta los requisitos de cumplimiento legal y regulatorio, así como obligaciones contractuales.', null, $texto_justificado);
        $phpWord->addTableStyle('tabla_partes_interesadas', $tableStyle);
        $table_partes_interesadas = $section->addTable('tabla_partes_interesadas');
        $table_partes_interesadas->addRow();
        $table_partes_interesadas->addCell(15000, ['gridSpan' => 3, 'valign' => 'center', 'bgColor' => '000000'])->addText('PARTES INTERESADAS', null, $texto_alinear_centro);
        $table_partes_interesadas->addRow();
        $table_partes_interesadas->addCell(4000, $secundario_tabla)->addText('Nombre');
        $table_partes_interesadas->addCell(5000, $secundario_tabla)->addText('Requisito');
        $table_partes_interesadas->addCell(6000, $secundario_tabla)->addText('Cláusula que satisface el requisito de la parte interesada');
        if ($partes_interesadas) {
            foreach ($partes_interesadas as $parte_interesada) {
                $table_partes_interesadas->addRow();
                $table_partes_interesadas->addCell(4000)->addText($parte_interesada->parteinteresada);
                $table_partes_interesadas->addCell(5000)->addText($parte_interesada->requisitos);
                $table_partes_interesadas->addCell(6000)->addText($parte_interesada->clausala);
            }
        } else {
            $table_partes_interesadas->addRow();
            $table_partes_interesadas->addCell(4000, $secundario_tabla)->addText('');
            $table_partes_interesadas->addCell(5000, $secundario_tabla)->addText('');
            $table_partes_interesadas->addCell(6000, $secundario_tabla)->addText('');
        }

        // Determinación del alcance del Sistema de Gestión de la Seguridad de la Información
        $section->addTextBreak(1);
        $section->addTitle('Determinación del alcance del Sistema de Gestión de la Seguridad de la Información', 1);
        $section->addText(
            $organizacion->empresa.' determina los límites y la aplicabilidad del Sistema de Gestión de la Seguridad de la Información para establecer su alcance:',
            null,
            $texto_justificado
        );
        $section->addText('Alcance?', null, $texto_justificado);
        // FIRMA
        $section->addPageBreak();
        $section->addTextBreak(2);
        $phpWord->addTableStyle('tabla_firmas', $tableStyle);
        $table_firmas = $section->addTable('tabla_firmas');
        $table_firmas->addRow();
        $table_firmas->addCell(7000, $secundario_tabla)->addText('Elaboró', $texto_negrita, $texto_alinear_centro);
        $table_firmas->addCell(7000, $secundario_tabla)->addText('Firma', $texto_negrita, $texto_alinear_centro);
        $table_firmas->addRow();
        $elaboro = $table_firmas->addCell(7000);
        $elaboro->addText('José Luis García Muciño', null, $texto_alinear_centro);
        $elaboro->addTextBreak(0.02);
        $elaboro->addText('Coordinador Ejecutivo en Procesos Administrativos', null, $texto_alinear_centro);
        $table_firmas->addCell(7000)->addText('');
        $table_firmas->addRow();
        $table_firmas->addCell(7000, $secundario_tabla)->addText('Revisó', $texto_negrita, $texto_alinear_centro);
        $table_firmas->addCell(7000, $secundario_tabla)->addText('Firma', $texto_negrita, $texto_alinear_centro);
        $table_firmas->addRow();
        $reviso = $table_firmas->addCell(7000);
        $reviso->addText('Salvador Mariano González Font', null, $texto_alinear_centro);
        $reviso->addTextBreak(0.02);
        $reviso->addText('Jefe de Departamento de Informática, Base de Datos y Seguridad', null, $texto_alinear_centro);
        $table_firmas->addCell(7000)->addText('');

        // Para que no diga que se abre en modo de compatibilidad
        $phpWord->getCompatibility()->setOoxmlVersion(15);
        // Idioma español de México
        $phpWord->getSettings()->setThemeFontLang(new Language('ES-MX'));

        return $phpWord;
    }
}
