<?php

namespace App\Http\Livewire;

// use App\Models\CategoriaObjetivosDesempeno;
use App\Models\ObjetivosDesempenoEmpleados;
use App\Models\PeriodoCargaObjetivos;
use App\Models\RH\MetricasObjetivo;
use App\Models\RH\Objetivo;
use App\Models\RH\ObjetivoEmpleado;
use App\Models\RH\TipoObjetivo;
use Livewire\Component;

class FormularioObjetivosDesempenoEmpleados extends Component
{
    public $id_emp;

    public $objetivos;

    public $categorias;
    public $unidades;

    public $periodo;

    public $objetivo_estrategico = '';
    public $descripcion = '';
    public $KPI = '';
    public $select_categoria = '';
    public $select_unidad = '';

    public $nombre_unidad;
    public $minimo_unidad;
    public $maximo_unidad;

    public function mount($id_empleado)
    {
        $this->categorias = TipoObjetivo::get();
        $this->periodo = PeriodoCargaObjetivos::get();
        $this->unidades = MetricasObjetivo::getAll();

        $this->id_emp = $id_empleado;
    }

    public function render()
    {
        $this->objetivos = ObjetivoEmpleado::getAllwithObjetivo()
            ->where('empleado_id', '=', $this->id_emp)
            ->where('papelera', false);
        // dd($this->objetivos);
        return view('livewire.formulario-objetivos-desempeno-empleados');
    }

    public function crearObjetivo()
    {
        Objetivo::create([
            'objetivo' => $this->objetivo_estrategico,
            'descripcion' => $this->descripcion,
            'categoria_objetivo_id' => $this->select_categoria,
            'KPI' => $this->KPI,
            'unidad_objetivo_id' => $this->select_unidad,
            'empleado_id' => $this->id_emp,
            'estatus' => 0,
        ]);

        $this->resetInputsObjetivo();
    }

    public function crearUnidad()
    {
        $unidad = MetricasObjetivo::create([
            'definicion' => $this->nombre_unidad,
            'valor_minimo' => $this->minimo_unidad,
            'valor_maximo' => $this->maximo_unidad,
        ]);

        $this->unidades = MetricasObjetivo::get();

        $this->resetInputsUnidad();
    }

    public function resetInputsUnidad()
    {
        $this->nombre_unidad = '';
        $this->minimo_unidad = 0;
        $this->maximo_unidad = 0;
    }

    public function resetInputsObjetivo()
    {
        $this->objetivo_estrategico = '';
        $this->descripcion = '';
        $this->KPI = '';
        $this->select_categoria = '';
        $this->select_unidad = '';
    }

    public function enviarPapelera($id_obj)
    {
        $objetivo = ObjetivoEmpleado::find($id_obj);

        $objetivo->update([
            'papelera' => true
        ]);
    }
}
