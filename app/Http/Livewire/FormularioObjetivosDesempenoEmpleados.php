<?php

namespace App\Http\Livewire;

use App\Models\CategoriaObjetivosDesempeno;
use App\Models\ObjetivosDesempenoEmpleados;
use App\Models\PeriodoCargaObjetivos;
use App\Models\UnidadObjetivosDesempeno;
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
        $this->categorias = CategoriaObjetivosDesempeno::get();
        $this->periodo = PeriodoCargaObjetivos::get();
        $this->unidades = UnidadObjetivosDesempeno::get();

        $this->id_emp = $id_empleado;
    }

    public function render()
    {
        $this->objetivos = ObjetivosDesempenoEmpleados::with('categoria', 'unidad')
            ->where('empleado_id', $this->id_emp)
            ->where('papelera', false)
            ->get();

        return view('livewire.formulario-objetivos-desempeno-empleados');
    }

    public function crearObjetivo()
    {
        ObjetivosDesempenoEmpleados::create([
            'objetivo' => $this->objetivo_estrategico,
            'descripcion' => $this->descripcion,
            'categoria_objetivo_id' => $this->select_categoria,
            'KPI' => $this->KPI,
            'unidad_objetivo_id' => $this->select_unidad,
            'empleado_id' => $this->id_emp,
        ]);

        $this->resetInputsObjetivo();
    }

    public function crearUnidad()
    {
        $unidad = UnidadObjetivosDesempeno::create([
            'nombre' => $this->nombre_unidad,
            'valor_minimo' => $this->minimo_unidad,
            'valor_maximo' => $this->maximo_unidad,
        ]);
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
        $objetivo = ObjetivosDesempenoEmpleados::find($id_obj);

        $objetivo->update([
            'papelera' => true
        ]);
    }
}
