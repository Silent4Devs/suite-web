<?php

namespace App\Http\Livewire\Visitantes;

use App\Models\Visitantes\RegistrarVisitante;
use Carbon\Carbon;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class RegistrarSalida extends Component
{
    use LivewireAlert;

    public $visitantes;
    public $visitante;
    public $firma;

    protected $rules = [
        'visitante' => 'nullable',
        'firma' => 'required'
    ];

    // protected $model = RegistrarVisitante::class;

    // public function configure(): void
    // {
    //     $this->setPrimaryKey('id');
    //     $this->setPerPageAccepted([5, 10, 25, 50, 100]);
    //     $this->setPerPage(5);
    // }

    // public function columns(): array
    // {
    //     return [
    //         Column::make('Nombre')
    //             ->sortable()
    //             ->searchable(),
    //         Column::make('Apellidos')
    //             ->sortable()
    //             ->searchable(),
    //         Column::make('Foto')
    //             ->format(function ($value) {
    //                 return '<img src="' . ($value ? $value : asset('assets/user.png')) . '" style="max-width: 80px;clip-path: circle();" width="50px" height="50px">';
    //             })
    //             ->html(),
    //         Column::make('Dispositivo')
    //             ->sortable()
    //             ->searchable(),
    //         Column::make('Serie')
    //             ->sortable()
    //             ->searchable(),
    //         Column::make('Motivo')
    //             ->sortable()
    //             ->searchable(),
    //         Column::make('Visita', 'tipo_visita')
    //             ->format(
    //                 function ($value, $row, $column) {
    //                     return $value;
    //                 }
    //             )
    //             ->sortable()
    //             ->searchable(),
    //         Column::make('Ingreso', 'created_at')
    //             ->format(
    //                 function ($value, $row, $column) {
    //                     return Carbon::parse($value)->format('d-m-Y h:i A');
    //                 }
    //             )
    //             ->sortable()
    //             ->searchable(),
    //         Column::make('Opciones', 'id')
    //             ->format(
    //                 function ($value, $row, $column) {
    //                     return '<i class="bi bi-box-arrow-left btn btn-sm" id="registrarSalida"
    //                     wire:click.prevent="openModal(' . $value . ')"></i>';
    //                 }
    //             )
    //             ->html(),
    //     ];
    // }

    public function hydrate()
    {
        $this->emit('datatable');
    }

    public function mount()
    {
        $this->visitantes = RegistrarVisitante::where('registro_salida', false)->get();
        $this->visitante = null;
    }

    public function render()
    {
        return view('livewire.visitantes.registrar-salida');
    }

    public function openModal($visitanteId)
    {
        $this->visitante = RegistrarVisitante::find($visitanteId);
        $this->emit('openModal', $this->visitante);
    }

    public function limpiarFirma()
    {
        dd('limpiar firma');
    }

    public function registrarSalida()
    {
        $registroVisitante = RegistrarVisitante::find($this->visitante->id);
        $registroVisitante->update([
            'fecha_salida' => Carbon::now(),
            'firma' => $this->firma,
            'registro_salida' => true,
        ]);
        $this->alert('success', 'Bien Hecho ' . $registroVisitante->nombre . ', has registrado tu salida correctamente', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
        ]);
        $this->visitantes = RegistrarVisitante::where('registro_salida', false)->get();
        $this->emit('closeModal',   $this->visitante);
    }
}
