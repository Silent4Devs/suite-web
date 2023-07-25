<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GlobalSearchController extends Controller
{
    private $models = [
        'Documento' => 'Documentos',
        'Empleado' => 'Empleados',
        // 'Organizacion'            => 'cruds.organizacion.title',
        // 'Glosario'                => 'cruds.glosario.title',
        // 'PartesInteresada'        => 'cruds.partesInteresada.title',
        // 'MatrizRequisitoLegale'   => 'cruds.matrizRequisitoLegale.title',
        // 'AlcanceSgsi'             => 'cruds.alcanceSgsi.title',
        // 'Comiteseguridad'         => 'cruds.comiteseguridad.title',
        // 'Minutasaltadireccion'    => 'cruds.minutasaltadireccion.title',
        // 'PoliticaSgsi'            => 'cruds.politicaSgsi.title',
        // 'Objetivosseguridad'      => 'cruds.objetivosseguridad.title',
        // 'Recurso'                 => 'cruds.recurso.title',
        // 'ConcientizacionSgi'      => 'cruds.concientizacionSgi.title',
        // 'MaterialSgsi'            => 'cruds.materialSgsi.title',
        // 'MaterialIsoVeinticiente' => 'cruds.materialIsoVeinticiente.title',
        // 'ComunicacionSgi'         => 'cruds.comunicacionSgi.title',
        // 'PlanificacionControl'    => 'cruds.planificacionControl.title',
        // 'TratamientoRiesgo'       => 'cruds.tratamientoRiesgo.title',
        // 'AuditoriaInterna'        => 'cruds.auditoriaInterna.title',
        // 'IndicadoresSgsi'         => 'cruds.indicadoresSgsi.title',
        // 'AuditoriaAnual'          => 'cruds.auditoriaAnual.title',
        // 'PlanAuditorium'          => 'cruds.planAuditorium.title',
        // 'AccionCorrectiva'        => 'cruds.accionCorrectiva.title',
        // 'PlanaccionCorrectiva'    => 'cruds.planaccionCorrectiva.title',
        // 'Registromejora'          => 'cruds.registromejora.title',
        // 'Dmaic'                   => 'cruds.dmaic.title',
        // 'PlanMejora'              => 'cruds.planMejora.title',
        // 'IncidentesDeSeguridad'   => 'cruds.incidentesDeSeguridad.title',
        // 'Archivo'                 => 'cruds.archivo.title',
    ];

    public function search(Request $request)
    {
        $search = $request->input('search');

        if ($search === null || ! isset($search['term'])) {
            abort(400);
        }

        $term = $search['term'];
        $searchableData = [];

        foreach ($this->models as $model => $translation) {
            $modelClass = 'App\Models\\'.$model;
            $query = $modelClass::query();

            $fields = $modelClass::$searchable;

            foreach ($fields as $field) {
                $query->orWhere($field, 'LIKE', '%'.$term.'%');
            }

            $results = $query->take(10)
                ->get();

            foreach ($results as $result) {
                $parsedData = $result->only($fields);
                $parsedData['model'] = trans($translation);
                $parsedData['fields'] = $fields;
                $formattedFields = [];

                foreach ($fields as $field) {
                    $formattedFields[$field] = Str::title(str_replace('_', ' ', $field));
                }

                $parsedData['fields_formated'] = $formattedFields;

                $parsedData['url'] = url(''.Str::plural(Str::snake($model, '-')).'/'.$result->id.'/edit');

                $searchableData[] = $parsedData;
            }
        }

        return response()->json(['results' => $searchableData]);
    }
}
