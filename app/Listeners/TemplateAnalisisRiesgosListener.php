<?php

namespace App\Listeners;

use App\Models\TBTemplateLogRiskAnalysisModel;

class TemplateAnalisisRiesgosListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle($event): void
    {
        $step = $event->step;

        switch ($step) {
            case 'TBEscalaAnalisisRiesgoModel':
                $template_id = $event->model->templateAr_escala->template_id;
                TBTemplateLogRiskAnalysisModel::create([
                    'step' => 'Escalas',
                    'action' => $event->tipo_consulta,
                    'empleado_id' => auth()->user()->empleado->id,
                    'template_id' => $template_id,
                ]);
                break;
            case 'TBProbabilidadImpactoAnalisisRiesgoModel':
                $template_id = $event->model->templateAr_prob_imp->template_id;
                TBTemplateLogRiskAnalysisModel::create([
                    'step' => 'Escalas',
                    'action' => $event->tipo_consulta,
                    'empleado_id' => auth()->user()->empleado->id,
                    'template_id' => $template_id,
                ]);
                break;
            case 'TBTemplateAr_EscalaArModel':
                $template_id = $event->model->template_id;
                TBTemplateLogRiskAnalysisModel::create([
                    'step' => 'Escalas',
                    'action' => $event->tipo_consulta,
                    'empleado_id' => auth()->user()->empleado->id,
                    'template_id' => $template_id,
                ]);
                break;
            case 'TBTemplateArProbImpArModel':
                $template_id = $event->model->template_id;
                TBTemplateLogRiskAnalysisModel::create([
                    'step' => 'Escalas',
                    'action' => $event->tipo_consulta,
                    'empleado_id' => auth()->user()->empleado->id,
                    'template_id' => $template_id,
                ]);
                break;
            case 'TBSectionTemplateAnalisisRiesgoModel':
                $template_id = $event->model->template_id;
                TBTemplateLogRiskAnalysisModel::create([
                    'step' => 'Template',
                    'action' => $event->tipo_consulta,
                    // 'empleado_id' => 354,
                    'template_id' => $template_id,
                    'empleado_id' =>  auth()->user()->empleado->id,
                ]);
                break;
            case 'TBQuestionTemplateAnalisisRiesgoModel':
                try {
                    $template_id = $event->model->sections[0]->template_id;
                    TBTemplateLogRiskAnalysisModel::create([
                        'step' => 'Template',
                        'action' => $event->tipo_consulta,
                        // 'empleado_id' => 354,
                        'template_id' => $template_id,
                        'empleado_id' =>  auth()->user()->empleado->id,
                    ]);
                } catch (\Throwable $th) {
                    //throw $th;
                }
                break;
            case 'TBFormulaTemplateAnalisisRiesgoModel':
                $template_id = $event->model->template_id;
                TBTemplateLogRiskAnalysisModel::create([
                    'step' => 'Formulas',
                    'action' => $event->tipo_consulta,
                    // 'empleado_id' => 354,
                    'template_id' => $template_id,
                    'empleado_id' =>  auth()->user()->empleado->id,
                ]);
                break;
            case 'TBSettingsTemplateAR_TBFormulaTemplateARModel':
                $template_id = $event->model->template_id;
                TBTemplateLogRiskAnalysisModel::create([
                    'step' => 'Configuración',
                    'action' => $event->tipo_consulta,
                    // 'empleado_id' => 354,
                    'template_id' => $template_id,
                    'empleado_id' =>  auth()->user()->empleado->id,
                ]);
                break;
            case 'TBSettingsTemplateAR_TBQuestionTemplateARModel':
                // $template_id = $event;
                // dd($template_id);
                // dd($event->model->template_id);
                $template_id = $event->model->template_id;
                TBTemplateLogRiskAnalysisModel::create([
                    'step' => 'Configuración',
                    'action' => $event->tipo_consulta,
                    // 'empleado_id' => 354,
                    'template_id' => $template_id,
                    'empleado_id' =>  auth()->user()->empleado->id,
                ]);
                break;
        }
    }
}
