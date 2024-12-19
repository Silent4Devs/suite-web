<?php

namespace App\Livewire\AnalisisRiesgos;

use App\Models\Iso27\GapDosCatalogoIso;
use App\Models\TBControlRiskAnalysisModel;
use App\Models\TBSheetRA_ControlRAModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Str;

class ControlsRiskAnalysis extends Component
{
    use WithFileUploads;

    public $riskAnalysisId;

    public $sheetId;

    public $controlsSheet = [];

    public $cloneControlsSheet = [];

    public $folder;

    protected $listeners = ['reload' => 'reload'];

    // #[On('updateData')]
    public function reload($sheetId)
    {
        // dd("aaa");
        $this->sheetId = $sheetId;
        $this->getControlsSheet();
    }

    public function deleteFile($index)
    {
        $this->controlsSheet[$index]['fileStatus'] = false;
        $this->controlsSheet[$index]['file'] = null;
    }

    public function download($path)
    {
        // dd($path);
        return response()->download(storage_path('app/'.$path));
    }

    public function controlFile($control)
    {
        $file = $control['file'];
        $uuid = Str::uuid()->toString();
        $date = Carbon::now()->format('d-m-Y');
        $fileName = 'control-'.$control['control'].'-'.$uuid.'-'.$date;
        $extension = $file->getClientOriginalExtension();
        $path = $file->storeAs($this->folder, $fileName.'.'.$extension);

        return $path;
    }

    public function editControlSheet($control)
    {

        if (! Storage::exists($this->folder)) {
            Storage::makeDirectory($this->folder);
        }
        if ($control['file'] && ! is_string($control['file'])) {
            $control['file'] = $this->controlFile($control);
        }
        $controlRegister = TBControlRiskAnalysisModel::find($control['id']);
        $controlRegister->update($control);
    }

    public function createControlSheet(&$control)
    {
        if ($control['file']) {
            $control['file'] = $this->controlFile($control);
        }

        $control['applicability'] = $control['applicability'] !== null ? $control['applicability'] : false;
        $control['is_apply'] = $control['is_apply'] !== null ? $control['is_apply'] : false;

        $controlSheetRegister = TBControlRiskAnalysisModel::create([
            'control_id' => $control['control_id'],
            'applicability' => $control['applicability'],
            'is_apply' => $control['is_apply'],
            'justification' => $control['justification'],
            'file' => $control['file'],
        ]);

        TBSheetRA_ControlRAModel::create([
            'sheet_id' => $this->sheetId,
            'control_sheet_id' => $controlSheetRegister->id,
        ]);

    }

    public function saveTable()
    {
        foreach ($this->controlsSheet as $index => $controlSheet) {
            if (
                $this->cloneControlsSheet[$index]['applicability'] !== $controlSheet['applicability'] ||
                $this->cloneControlsSheet[$index]['is_apply'] !== $controlSheet['is_apply'] ||
                $this->cloneControlsSheet[$index]['justification'] !== $controlSheet['justification'] ||
                $this->cloneControlsSheet[$index]['file'] !== $controlSheet['file']
            ) {
                if ($controlSheet['sheet_id']) {
                    $this->editControlSheet($controlSheet);
                } else {
                    $this->createControlSheet($controlSheet);
                    // dump($controlSheet);
                }
            }
        }

        $this->dispatch('responseTableControls');
        $this->getControlsSheet();
    }

    public function getControlsSheet()
    {
        // $this->controlsSheet = collect([]);
        $catalogueControls = GapDosCatalogoIso::select('id', 'control_iso', 'anexo_politica')->get();
        $idsCatalogueControls = $catalogueControls->pluck('id');

        $controlsRegisters = TBSheetRA_ControlRAModel::where('sheet_id', $this->sheetId)->get();
        $idsControlsRegister = $controlsRegisters->pluck('controlSheet.control_id');

        $controlsSame = [];
        $controlsDiferent = [];

        // filter controls same
        $controlsRegisters->filter(function ($item) use ($idsCatalogueControls, &$controlsSame) {
            if ($idsCatalogueControls->contains(optional($item->controlSheet)->control_id)) {
                $data = [
                    'id' => $item->controlSheet->id,
                    'sheet_id' => $item->sheet_id,
                    'control_id' => $item->controlSheet->control_id,
                    'control' => $item->controlSheet->control->control_iso,
                    'control_name' => $item->controlSheet->control->anexo_politica,
                    'applicability' => $item->controlSheet->applicability,
                    'is_apply' => $item->controlSheet->is_apply,
                    'justification' => $item->controlSheet->justification,
                    'file' => $item->controlSheet->file,
                    'fileStatus' => $item->controlSheet->file ? true : false,
                ];
                $controlsSame[] = ($data);
            }
        });
        // flter controls diferent
        $catalogueControls->filter(function ($item) use ($idsControlsRegister, &$controlsDiferent) {
            if (! $idsControlsRegister->contains(optional($item)->id)) {
                $data = [
                    'id' => null,
                    'sheet_id' => null,
                    'control_id' => $item->id,
                    'control' => $item->control_iso,
                    'control_name' => $item->anexo_politica,
                    'applicability' => null,
                    'is_apply' => null,
                    'justification' => null,
                    'file' => null,
                    'fileStatus' => false,
                ];
                $controlsDiferent[] = ($data);
            }
        });

        // $controlsSame = collect($controlsSame);
        // dd($controlsSame[0]->control_name);
        $this->controlsSheet = array_merge($controlsSame, $controlsDiferent);
        // dd( $this->controlsSheet);
        // dd($this->controlsSheet[0]->control_name);

        // $this->controlsSheet = $this->controlsSheet->merge($controlsSame);
        // $this->controlsSheet = $this->controlsSheet->merge($controlsDiferent);
        // clone for camparate
        $this->cloneControlsSheet = $this->controlsSheet;
    }

    public function mount($riskAnalysisId)
    {
        $this->riskAnalysisId = $riskAnalysisId;
        $this->folder = 'public/risk_analysis/'.$this->riskAnalysisId;
        // dd($riskAnalysisId);
    }

    public function render()
    {
        // $this->dispatch('ejecutarScript');
        // $this->dispatch('scriptTabla2');

        return view('livewire.analisis-riesgos.controls-risk-analysis');
    }
}
