<?php

namespace App\Livewire;

use App\Models\Area;
use App\Models\ContractManager\Sucursal;
use App\Models\Organizacion;
use App\Models\TimesheetCliente;
use App\Models\TimesheetProyecto;
use Livewire\Attributes\Validate;
use Livewire\Component;

class FormularioCrearContratosLivewire extends Component
{
    #Variables del select para la creacion del proyecto
    public $areas;
    public $organizacion;
    public $proyectos;
    public $proveedores;
    public $razones_sociales;

    public $tipos_contrato = [
        'Abastecimiento y Distribución de Revista y Periódicos',
        'Abastecimiento y Distribución de Revista y Periódicos',
        'Adquisición de Mascarillas',
        'Adquisición de Papelería',
        'Adquisición de Pruebas COVID',
        'Administrativo',
        'Arrendamiento de Equipos',
        'Educación Continua',
        'Fábrica de Desarrollo',
        'Fábrica de Pruebas',
        'Impresión',
        'Infraestructura',
        'Licenciamiento',
        'Mantenimiento a Edificio',
        'Restauración de Edificios',
        'Seguridad de la Información',
        'Seguridad y Vigilancia',
        'Servicio de Estacionamiento',
        'Servicio de Limpieza',
        'Servicio de Seguros',
        'Servicios de Alimentos',
        'Servicios de Consultoría',
        'Servicios de Consultoría Normativa',
        'Servicios en la Nube',
        'Servicios Médicos',
        'Telecomunicaciones',
        'Otro'
    ];

    public $fases = [
        'Aprobación',
        'Auditoría y reportes',
        'Autorización',
        'Ejecución',
        'Gestión de obligaciones',
        'Modificación de contrato',
        'Negociación',
        'Renovación',
        'Solicitud de contrato'
    ];

    public $estatuses = [
        'Cerrado',
        'renovaciones',
        'vigentes'
    ];

    public $no_contrato, $nombre_servicio, $tipo_contrato, $proveedor_id, $area_id, $objetivo, $estatus,
        $cargo_administrador, $area_administrador, $puesto, $area, $file_contrato, $fase,
        $vigencia_contrato, $fecha_inicio, $fecha_fin, $fecha_firma, $no_pagos, $tipo_cambio,
        $monto_pago, $minimo, $maximo, $monto_dolares, $maximo_dolares, $minimo_dolares,
        $valor_dolar, $pmp_asignado, $no_proyecto, $identificador, $tipo, $proyecto_name,
        $sede_id, $fecha_inicio_proyecto, $fecha_fin_proyecto, $horas_proyecto, $razon_soc_id,
        $creacion_proyecto, $identificador_privado;

    protected $rules = [
    'no_contrato' => 'required_unless:identificador_privado,1',
    'nombre_servicio' => 'required|max:500',
    'tipo_contrato' => 'required',
    'proveedor_id' => 'required',
    'area_id' => 'required',
    'objetivo' => 'required|max:500',
    'estatus' => 'required|max:255',
    'cargo_administrador' => 'max:250',
    'area_administrador' => 'max:250',
    'puesto' => 'max:250',
    'area' => 'max:250',
    'file_contrato' => 'required',
    'fase' => 'required|max:255',
    'vigencia_contrato' => 'required',
    'fecha_inicio' => 'required|date',
    'fecha_fin' => 'required|after:fecha_inicio|date',
    'fecha_firma' => 'required|before_or_equal:fecha_fin|date',
    'no_pagos' => 'required|numeric|lte:500000',
    'tipo_cambio' => 'required',
    'monto_pago' => 'required|numeric|min:0|max:99999999999.99',
    'minimo' => 'nullable|numeric|max:99999999999.99',
    'maximo' => 'nullable|numeric|max:99999999999.99',
    'monto_dolares' => 'nullable|numeric|max:99999999999.99',
    'maximo_dolares' => 'nullable|numeric|max:99999999999.99',
    'minimo_dolares' => 'nullable|numeric|max:99999999999.99',
    'valor_dolar' => 'nullable|numeric|max:99999999999.99',
    'pmp_asignado' => 'required',
    'no_proyecto' => 'required_if:creacion_proyecto,false|string',
    'identificador' => 'required_if:creacion_proyecto,true|string|max:255',
    'tipo' => 'required_if:creacion_proyecto,true|string|max:255',
    'proyecto_name' => 'required_if:creacion_proyecto,true|string|max:255',
    'sede_id' => 'nullable|integer|exists:sedes,id',
    'fecha_inicio_proyecto' => 'nullable|date',
    'fecha_fin_proyecto' => 'nullable|date|after_or_equal:fecha_inicio_proyecto',
    'horas_proyecto' => 'nullable|integer|min:0',
    'razon_soc_id' => 'required|integer',
    ];

    protected $messages = [
    'no_proyecto.int' => 'Debe seleccionar un proyecto o crear uno.',
    'monto_pago.max' => 'El monto total debe ser menor a 99,999,999,999.99',
    'maximo.max' => 'El monto total debe ser menor a 99,999,999,999.99',
    'minimo.max' => 'El monto total debe ser menor a 99,999,999,999.99',
    'monto_dolares.max' => 'El monto total debe ser menor a 99,999,999,999.99',
    'maximo_dolares.max' => 'El monto total debe ser menor a 99,999,999,999.99',
    'minimo_dolares.max' => 'El monto total debe ser menor a 99,999,999,999.99',
    'valor_dolar.max' => 'El valor del dolar no puede superar 99,999,999,999.99',
    'fecha_firma.after_or_equal' => 'La fecha firma no puede ser antes de la fecha inicio del contrato',
    'no_contrato.required_unless' => 'Solo los Contratos privados no requieren Numero de Contrato',
    ];

    public function mount(){
        $this->areas = Area::getAll()->sortBy('area');
        $this->organizacion = Organizacion::getFirst();
        $this->proyectos = TimesheetProyecto::getAll()->where('estatus', 'proceso')->sortBy('proyecto');
        $this->proveedores = TimesheetCliente::select('id', 'razon_social', 'nombre')->orderBy('nombre')->get();
        $this->razones_sociales = Sucursal::getArchivoFalse()->sortBy('descripcion');
    }

    public function render()
    {
        return view('livewire.formulario-crear-contratos-livewire');
    }

    public function save(){
        $validatedData  = $this->validate();
        dd($validatedData);
    }
}
