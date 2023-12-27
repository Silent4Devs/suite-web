<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPoliticaSgsiRequest;
use App\Http\Requests\StorePoliticaSgsiRequest;
use App\Http\Requests\UpdatePoliticaSgsiRequest;
use App\Mail\PoliticasEstatusEmail;
use App\Models\ControlListaDistribucion;
use App\Models\Empleado;
use App\Models\ListaDistribucion;
use App\Models\Organizacion;
use App\Models\PoliticaSgsi;
use App\Models\ProcesosListaDistribucion;
use App\Models\Team;
use App\Models\User;
use App\Traits\ObtenerOrganizacion;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use PDF;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PoliticaSgsiController extends Controller
{
    use ObtenerOrganizacion;

    public $modelo =  'PoliticaSgsi';

    public function index(Request $request)
    {
        abort_if(Gate::denies('politica_sistema_gestion_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PoliticaSgsi::with(['team', 'reviso'])->select(sprintf('%s.*', (new PoliticaSgsi)->table))->orderByDesc('id');
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'politica_sistema_gestion_ver';
                $editGate = 'politica_sistema_gestion_editar';
                $deleteGate = 'politica_sistema_gestion_eliminar';
                $crudRoutePart = 'politica-sgsis';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('nombre_politica', function ($row) {
                return $row->nombre_politica ? $row->nombre_politica : '';
            });
            $table->editColumn('politicasgsi', function ($row) {
                return $row->politicasgsi ? html_entity_decode(strip_tags($row->politicasgsi), ENT_QUOTES, 'UTF-8') : '';
                // return $row->politicasgsi ? strip_tags($row->politicasgsi) : '';
            });
            $table->editColumn('fecha_publicacion', function ($row) {
                return $row->fecha_publicacion ? $row->fecha_publicacion : '';
            });
            $table->editColumn('fecha_entrada', function ($row) {
                return $row->fecha_entrada ? $row->fecha_entrada : '';
            });
            $table->addColumn('reviso_politica', function ($row) {
                return $row->reviso ? $row->reviso->empleado->name : '';
            });
            $table->editColumn('puesto_reviso', function ($row) {
                return $row->reviso ? $row->reviso->puesto : '';
            });
            $table->editColumn('area_reviso', function ($row) {
                return $row->reviso ? $row->reviso->area->area : '';
            });
            $table->editColumn('fecha_revision', function ($row) {
                return $row->fecha_revision ? $row->fecha_revision : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $politicaSgsis = PoliticaSgsi::getAll();

        $teams = Team::get();

        $empleados = Empleado::getAltaEmpleadosWithArea();

        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;
        $direccion = $organizacion_actual->direccion;
        $rfc = $organizacion_actual->rfc;

        return view('admin.politicaSgsis.index', compact('politicaSgsis', 'teams', 'empleados', 'organizacion_actual', 'logo_actual', 'empresa_actual', 'direccion', 'rfc'));
    }

    public function create()
    {
        abort_if(Gate::denies('politica_sistema_gestion_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $empleados = Empleado::getAltaEmpleadosWithArea();

        return view('admin.politicaSgsis.create', compact('empleados'));
    }

    public function store(StorePoliticaSgsiRequest $request)
    {
        abort_if(Gate::denies('politica_sistema_gestion_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validate([
            'nombre_politica' => 'required',
            'politicasgsi' => 'required',
            'fecha_publicacion' => 'required|date',
            'fecha_revision' => 'required|date',
        ]);

        $politicaSgsi = PoliticaSgsi::create([
            'nombre_politica' => $request->input('nombre_politica'),
            'politicasgsi' => $request->input('politicasgsi'),
            'fecha_publicacion' => $request->input('fecha_publicacion'),
            'fecha_revision' => $request->input('fecha_revision'),
            'estatus' => 'pendiente'
        ]);

        //envio de corrreo
        $this->listaDistribucion($politicaSgsi);

        $politicaSgsi->estatus =  'pendiente';

        return redirect()->route('admin.politica-sgsis.index')->with('success', 'Guardado con éxito');
    }

    public function listaDistribucion($politicaSgsi)
    {
        // dd($requisito, $array_requisito);
        $lista = ListaDistribucion::with('participantes')->where('modelo', '=', $this->modelo)->first();
        $creador = User::getCurrentUser()->empleado->id; // Replace 123 with your specific empleado_id value
        // $no_niveles = $lista->niveles;
        // dd($lista, $no_niveles);

        $proceso = ProcesosListaDistribucion::updateOrCreate(
            [
                'modulo_id' => $lista->id,
                'proceso_id' => $politicaSgsi->id, //Este es solo el numero del id del respectivo FODA, no esta relacionado a nada, pero se necesita el valor
            ],
            [
                'estatus' => 'Pendiente',
            ]
        );
        // dd($lista, $id_foda, $this->modelo, $proceso);

        foreach ($lista->participantes as $participante) {
            $participantes = ControlListaDistribucion::updateOrCreate(
                [
                    'proceso_id' => $proceso->id,
                    'participante_id' => $participante->id,
                ],
                [
                    'estatus' => 'Pendiente',
                ]
            );
        }
        $this->envioCorreos($proceso, $politicaSgsi);
    }

    public function envioCorreos($proceso, $politicaSgsi)
    {
        foreach ($proceso->participantes as $part) {
            if ($part->participante->nivel == 0) {
                $emailSuperAprobador = $part->participante->empleado->email;
                Mail::to(removeUnicodeCharacters($emailSuperAprobador))->send(new PoliticasEstatusEmail($politicaSgsi->id));
                // dd('primer usuario', $part->participante);
            }
        }

        //Aprobadores normales
        // for ($i = 1; $i <= $no_niveles; $i++) {
        foreach ($proceso->participantes as $part) {
            if ($part->participante->nivel == 1) {
                // for ($j = 1; $j <= 5; $j++) {
                if ($part->participante->numero_orden == 1) {
                    $emailAprobador = $part->participante->empleado->email;
                    Mail::to(removeUnicodeCharacters($emailAprobador))->send(new PoliticasEstatusEmail($politicaSgsi->id));
                    break;
                }
                // }
            }
            // }
        }
    }

    public function edit(PoliticaSgsi $politicaSgsi)
    {
        abort_if(Gate::denies('politica_sistema_gestion_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $politicaSgsi->load('team');

        $empleados = Empleado::getAltaEmpleadosWithArea();

        return view('admin.politicaSgsis.edit', compact('politicaSgsi', 'empleados'));
    }

    public function update(UpdatePoliticaSgsiRequest $request, PoliticaSgsi $politicaSgsi)
    {
        abort_if(Gate::denies('politica_sistema_gestion_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validate([
            'nombre_politica' => 'required',
            'politicasgsi' => 'required',
            'id_reviso_politica' => 'required',
            'fecha_publicacion' => 'required',
            'fecha_revision' =>  'required',
        ]);

        $politicaSgsi->update([
            'nombre_politica' => $request->input('nombre_politica'),
            'politicasgsi' => $request->input('politicasgsi'),
            'fecha_publicacion' => $request->input('fecha_publicacion'),
            'fecha_revision' => $request->input('fecha_revision'),
            'estatus' => 'pendiente'
        ]);

        return redirect()->route('admin.politica-sgsis.index')->with('success', 'Editado con éxito');
    }

    public function show(PoliticaSgsi $politicaSgsi)
    {
        abort_if(Gate::denies('politica_sistema_gestion_ver'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $politicaSgsi->load('team');

        return view('admin.politicaSgsis.show', compact('politicaSgsi'));
    }

    public function destroy(PoliticaSgsi $politicaSgsi)
    {
        abort_if(Gate::denies('politica_sistema_gestion_eliminar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $politicaSgsi->delete();

        return back()->with('deleted', 'Registro eliminado con éxito');
    }

    public function massDestroy(MassDestroyPoliticaSgsiRequest $request)
    {
        PoliticaSgsi::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function visualizacion()
    {
        $politicaSgsis = PoliticaSgsi::where('estatus', 'aprobado')->get();
        foreach ($politicaSgsis as $polsgsis) {
            if (!isset($polsgsis->reviso)) {
                $polsgsis->revisobaja = PoliticaSgsi::with('revisobaja')->first();
                $polsgsis->estemp = 'baja';
            } else {
                $polsgsis->estemp = 'alta';
            }
        }
        $organizacions = Organizacion::getFirst();

        return view('admin.politicaSgsis.visualizacion', compact('politicaSgsis', 'organizacions'));
    }

    public function pdf()
    {

        $politicas = PoliticaSgsi::get();
        $organizacions = Organizacion::getFirst();

        $pdf = PDF::loadView('pdf', compact('politicas', 'organizacions'));
        $pdf->setPaper('A4', 'portrait');

        return $pdf->download('politicas.pdf');
    }
}
