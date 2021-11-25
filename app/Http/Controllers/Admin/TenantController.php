<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant;
use Yajra\DataTables\Facades\DataTables;
use Flash;
use App\Repositories\TenantRepository;
use App\Http\Controllers\Traits\CsvImportTrait;

class TenantController extends Controller
{
    use CsvImportTrait;
    /** @var TenantRepository */
    private $tenantRepository;

    public function __construct(TenantRepository $tenantRepo){
        $this->tenantRepository = $tenantRepo;
    }

    public function index(Request $request){
        if ($request->ajax()) {
            $query = Tenant::orderByDesc('id')->get();
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'user_show';
                $editGate = 'user_edit';
                $deleteGate = 'user_delete';
                $crudRoutePart = 'tenant';

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
            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.tenant.index');
    }

    public function store(Request $request){

        $tenant = Tenant::create([
        "id" => $request->id,
        'plan' => 'free',
        ]);
        $tenant->domains()->create([
            "domain"=>$request->id.".localhost"
        ]);
        return redirect()->route('admin.tenant.index');
        }


    public function create(){
            return view('admin.tenant.create');
    }

    public function edit($id){
    $tenant = $this->tenantRepository->find($id);
    if (empty($tenant))
        {
        Flash::error('Tenant not found');
        return redirect(route('admin.tenant.index'));
        }
    return view('admin.tenant.edit')->with('tenant', $tenant);
    }

    public function update(Request $request, $id){
        $tenant = $this->tenantRepository->find($id);
        if (empty($tenant))
        {
            Flash::error('Tenant not found');
            return redirect(route('admin.tenant.index'));
        }
        $tenant = $this->tenantRepository->update($request->all(), $id);
        // $tenant->domains()->edit([
        //     "domain"=>$request->id.".localhost"]);
        Flash::success('Tenant actualizado.');
        return redirect(route('admin.tenant.index'));
    }

    public function destroy(Tenant $tenant){
        $tenant->delete();
        return redirect(route('admin.tenant.index'));
    }
}
