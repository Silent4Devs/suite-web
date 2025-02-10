<?php

namespace App\Livewire;

use App\Models\Area;
use App\Models\User;
use Livewire\Component;
use App\Models\FirmaModule;
use App\Models\Organizacion;
use Illuminate\Http\Request;
use App\Rules\NumeroContrato;
use App\Models\TimesheetCliente;
use App\Functions\FormatearFecha;
use App\Models\TimesheetProyecto;
use App\Models\ConvergenciaContratos;
use App\Models\AprobadorFirmaContrato;
use Illuminate\Support\Facades\Storage;
use App\Models\ContractManager\Contrato;
use App\Models\ContractManager\Sucursal;
use App\Models\AprobadorFirmaContratoHistorico;
use App\Models\ContractManager\DolaresContrato;
use App\Models\ContractManager\ConveniosModificatorios;
use Mgcodeur\CurrencyConverter\Facades\CurrencyConverter;
use Livewire\WithFileUploads;
use App\Models\RazonSocial;
use App\Models\Proveedor;
use App\Models\Proyecto;
use Illuminate\Support\Facades\Mail;
use App\Mail\AprobadorFirmaContratoMail;
use App\Events\ContratoEvent;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class FormularioEditarContratosLivewire extends Component
{
    use WithFileUploads;
    use LivewireAlert;

    public $contrato;
    public $show_contrato;
    public $razones_sociales;
    public $proveedores;
    public $areas;
    public $proyectos;
    public $convenios;
    public $dolares;
    public $organizacion;
    public $file_contrato;
    public $documento;

    // Propiedades del formulario
    public $no_contrato;
    public $no_proyecto;
    public $nombre_servicio;
    public $tipo_contrato;
    public $proveedor_id;
    public $objetivo;
    public $estatus;
    public $cargo_administrador;
    public $area_administrador;
    public $puesto;
    public $area;
    public $fase;
    public $vigencia_contrato;
    public $fecha_inicio;
    public $fecha_fin;
    public $area_id;
    public $fecha_firma;
    public $no_pagos;

    public $razon_soc_id;
    public $pmp_asignado;
    public $administrador_contrato;
    public $folio;
    public $aplicaFinaza;

    //Aplica fianza
    public $proyecto;
    public $identificador_proyect;
    public $select_tipos = [];
    public $tipo;
    public $mensaje = null;
    public $class = 'success';
    public $colorTexto = '';

    //Moneda extranjera
    public $divisas;
    public $tipo_cambio = 'MXN';
    public $valor_dolar = 0;
    public $moneda_extranjera = false;
    public $edit_moneda = false;
    public $monto_dolares = 0;
    public $maximo_dolares = 0;
    public $minimo_dolares = 0;
    public $monto_pago = 0;
    public $maximo = 0;
    public $minimo = 0;

    public $firma;
    public $aprobacionFirmaContrato;
    public $firmar;
    public $firmado;

    // public $aprobadores_firma;

    // Inicialización del componente
    public function mount($IDContrato, $showC = false)
    {
        $this->contrato = Contrato::with('ampliaciones', 'dolares')->find($IDContrato);

        if (!$this->contrato) {
            return redirect()->route('contract_manager.contratos-katbol.index')->with('error', 'Ocurrió un error.');
        }

        $this->show_contrato = $showC;
        $this->areas = Area::all();
        $this->proveedores = TimesheetCliente::all();
        $this->convenios = ConveniosModificatorios::where('contrato_id', $this->contrato->id)->get();
        $this->dolares = DolaresContrato::where('contrato_id', $IDContrato)->first();
        $this->organizacion = Organizacion::first();
        $this->proyectos = TimesheetProyecto::where('estatus', 'proceso')->get();
        $this->razones_sociales = Sucursal::where('archivo', false)->get();

        // Precargar datos del contrato
        $this->no_contrato = $this->contrato->no_contrato;
        $this->no_proyecto = $this->contrato->no_proyecto;
        $this->nombre_servicio = $this->contrato->nombre_servicio;
        $this->tipo_contrato = $this->contrato->tipo_contrato;
        $this->proveedor_id = $this->contrato->proveedor_id;
        $this->objetivo = $this->contrato->objetivo;
        $this->estatus = $this->contrato->estatus;
        $this->cargo_administrador = $this->contrato->cargo_administrador;
        $this->area_administrador = $this->contrato->area_administrador;
        $this->puesto = $this->contrato->puesto;
        $this->area = $this->contrato->area;
        $this->fase = $this->contrato->fase;
        $this->vigencia_contrato = $this->contrato->vigencia_contrato;
        $this->fecha_inicio = $this->contrato->fecha_inicio;
        $this->fecha_fin = $this->contrato->fecha_fin;
        $this->area_id = $this->contrato->area_id;
        $this->fecha_firma = $this->contrato->fecha_firma;
        $this->no_pagos = $this->contrato->no_pagos;
        $this->tipo_cambio = $this->contrato->tipo_cambio;
        $this->monto_pago = $this->contrato->monto_pago;
        $this->minimo = $this->contrato->minimo;
        $this->maximo = $this->contrato->maximo;
        $this->monto_dolares = $this->dolares->monto_dolares ?? null;
        $this->maximo_dolares = $this->dolares->maximo_dolares ?? null;
        $this->minimo_dolares = $this->dolares->minimo_dolares ?? null;
        $this->razon_soc_id = $this->contrato->razon_soc_id;
        $this->pmp_asignado = $this->contrato->pmp_asignado;
        $this->administrador_contrato = $this->contrato->administrador_contrato;
        $this->folio = $this->contrato->folio;
        $this->aplicaFinaza = $this->contrato->documento || $this->contrato->folio;

        if (! empty($this->contrato->dolares->monto_dolares)) {
            // code...
            $this->moneda_extranjera = true;

            $this->tipo_cambio = $this->contrato->tipo_cambio ?? 'MXN';

            $this->valor_dolar = $this->contrato->dolares->valor_dolar ?? 0;

            $this->monto_dolares = $this->contrato->dolares->monto_dolares;
            $this->maximo_dolares = $this->contrato->dolares->maximo_dolares ?? 0;
            $this->minimo_dolares = $this->contrato->dolares->minimo_dolares ?? 0;
        }

        $this->monto_pago = $this->contrato->monto_pago;
        $this->maximo = $this->contrato->maximo;
        $this->minimo = $this->contrato->minimo;

        $this->divisas = [
            'MXN',
            'USD',
        ];

        // firmas aprobadores
        $this->firma = FirmaModule::where('modulo_id', '2')->where('submodulo_id', '7')->first();

        $this->aprobacionFirmaContrato = AprobadorFirmaContrato::where('contrato_id', $this->contrato->id)->get();
        $this->firmar = false;
        $this->firmado = false;
        foreach ($this->aprobacionFirmaContrato as $firma_item) {
            if ($firma_item->aprobador_id == User::getCurrentUser()->empleado->id) {
                if (! isset($firma_item->firma)) {
                    $this->firmar = true;
                }
            }
            if ($firma_item->firma) {
                $this->firmado = true;
            }
        }
        $aprobacionFirmaContratoHisotricoLast = AprobadorFirmaContratoHistorico::where('contrato_id', $this->contrato->id)->orderBy('id', 'DESC')->first();
    }

    // Renderizar la vista
    public function render()
    {
        return view('livewire.formulario-editar-contratos-livewire');
    }

    // Función para validar los campos
    public function validarCampos()
    {
        $errores = [];

        // Validación de campos
        if (empty($this->no_contrato)) {
            $errores[] = 'El campo Número de Contrato es obligatorio.';
        }else{
            $id_contrato = $this->contrato->id;
            $no_contrato = $this->no_contrato;
            $pertenece_no_contrato_editable = Contrato::where('id', '=', $id_contrato)->where('no_contrato', '=', $no_contrato)->exists();
            $existe_numero_contrato = Contrato::where('no_contrato', '=', $no_contrato)->exists();
            if (!$pertenece_no_contrato_editable) {
                if ($existe_numero_contrato) {
                    $errores[] = 'El campo Número de Proyecto ya existe en otro proyecto.';
                }
            }
        }

        // Validación de campos
        if (empty($this->no_proyecto)) {
            $errores[] = 'El campo Número de Proyecto es obligatorio.';
        }

        if (empty($this->nombre_servicio) || strlen($this->nombre_servicio) > 500) {
            $errores[] = 'El campo Nombre del Servicio es obligatorio y debe tener máximo 500 caracteres.';
        }

        if (empty($this->tipo_contrato)) {
            $errores[] = 'El campo Tipo de Contrato es obligatorio.';
        }

        if (empty($this->proveedor_id)) {
            $errores[] = 'El campo Proveedor es obligatorio.';
        }

        if (empty($this->objetivo) || strlen($this->objetivo) > 500) {
            $errores[] = 'El campo Objetivo es obligatorio y debe tener máximo 500 caracteres.';
        }

        if (empty($this->estatus) || strlen($this->estatus) > 255) {
            $errores[] = 'El campo Estatus es obligatorio y debe tener máximo 255 caracteres.';
        }

        if (strlen($this->cargo_administrador) > 250) {
            $errores[] = 'El campo Cargo del Administrador debe tener máximo 250 caracteres.';
        }

        if (strlen($this->area_administrador) > 250) {
            $errores[] = 'El campo Área del Administrador debe tener máximo 250 caracteres.';
        }

        if (strlen($this->puesto) > 250) {
            $errores[] = 'El campo Puesto debe tener máximo 250 caracteres.';
        }

        if (strlen($this->area) > 250) {
            $errores[] = 'El campo Área debe tener máximo 250 caracteres.';
        }

        if (empty($this->fase)) {
            $errores[] = 'El campo Fase es obligatorio.';
        }

        if (empty($this->vigencia_contrato) || strlen($this->vigencia_contrato) > 255) {
            $errores[] = 'El campo Vigencia del Contrato es obligatorio y debe tener máximo 255 caracteres.';
        }

        if (empty($this->fecha_inicio)) {
            $errores[] = 'El campo Fecha de Inicio es obligatorio.';
        }

        if (empty($this->fecha_fin) || $this->fecha_fin <= $this->fecha_inicio) {
            $errores[] = 'El campo Fecha de Fin es obligatorio y debe ser posterior a la Fecha de Inicio.';
        }

        if (empty($this->area_id)) {
            $errores[] = 'El campo Área es obligatorio.';
        }

        if (empty($this->fecha_firma) || $this->fecha_firma > $this->fecha_fin) {
            $errores[] = 'El campo Fecha de Firma es obligatorio y debe ser anterior o igual a la Fecha de Fin.';
        }

        if (empty($this->no_pagos) || !is_numeric($this->no_pagos) || $this->no_pagos > 500000) {
            $errores[] = 'El campo Número de Pagos es obligatorio, debe ser numérico y menor o igual a 500,000.';
        }

        if (empty($this->tipo_cambio)) {
            $errores[] = 'El campo Tipo de Cambio es obligatorio.';
        }

        if (empty($this->monto_pago) || !is_numeric($this->monto_pago) || $this->monto_pago < 0 || $this->monto_pago > 99999999999.99) {
            $errores[] = 'El campo Monto de Pago es obligatorio, debe ser numérico y estar entre 0 y 99,999,999,999.99.';
        }

        if (!empty($this->minimo) && (!is_numeric($this->minimo) || $this->minimo > 99999999999.99)) {
            $errores[] = 'El campo Mínimo debe ser numérico y menor o igual a 99,999,999,999.99.';
        }

        if (!empty($this->maximo) && (!is_numeric($this->maximo) || $this->maximo > 99999999999.99)) {
            $errores[] = 'El campo Máximo debe ser numérico y menor o igual a 99,999,999,999.99.';
        }

        if (!empty($this->monto_dolares) && (!is_numeric($this->monto_dolares) || $this->monto_dolares > 99999999999.99)) {
            $errores[] = 'El campo Monto en Dólares debe ser numérico y menor o igual a 99,999,999,999.99.';
        }

        if (!empty($this->maximo_dolares) && (!is_numeric($this->maximo_dolares) || $this->maximo_dolares > 99999999999.99)) {
            $errores[] = 'El campo Máximo en Dólares debe ser numérico y menor o igual a 99,999,999,999.99.';
        }

        if (!empty($this->minimo_dolares) && (!is_numeric($this->minimo_dolares) || $this->minimo_dolares > 99999999999.99)) {
            $errores[] = 'El campo Mínimo en Dólares debe ser numérico y menor o igual a 99,999,999,999.99.';
        }

        if (empty($this->pmp_asignado) || strlen($this->pmp_asignado) > 250) {
            $errores[] = 'El campo Nombre del Supervisor 1 es obligatorio y debe tener máximo 250 caracteres.';
        }

        if (strlen($this->administrador_contrato) > 250) {
            $errores[] = 'El campo Nombre del Supervisor 2 debe tener máximo 250 caracteres.';
        }

        if (strlen($this->folio) > 250) {
            $errores[] = 'El campo Folio debe tener máximo 250 caracteres.';
        }

        // Mostrar errores si existen
        if (!empty($errores)) {
            foreach ($errores as $error) {
                $this->alert('error', $error);
            }
            return false;
        }

        return true;
    }

    // Función para actualizar el contrato
    public function updateContrato()
    {
        ob_start();
        ini_set('memory_limit', '512M');
        try {
            // Validar los campos
            if (!$this->validarCampos()) {
                return;
            }

            // Limpiar valores monetarios
            $monto_pago = str_replace(['$', ','], '', $this->monto_pago);
            $minimo = str_replace(['$', ','], '', $this->minimo);
            $maximo = str_replace(['$', ','], '', $this->maximo);
            $monto_dolares = str_replace(['$', ','], '', $this->monto_dolares);
            $maximo_dolares = str_replace(['$', ','], '', $this->maximo_dolares);
            $minimo_dolares = str_replace(['$', ','], '', $this->minimo_dolares);

            // Actualizar el contrato
            $this->contrato->update([
                'no_contrato' => $this->no_contrato,
                'no_proyecto' => $this->no_proyecto,
                'nombre_servicio' => $this->nombre_servicio,
                'tipo_contrato' => $this->tipo_contrato,
                'proveedor_id' => $this->proveedor_id,
                'objetivo' => $this->objetivo,
                'estatus' => $this->estatus,
                'cargo_administrador' => $this->cargo_administrador,
                'area_administrador' => $this->area_administrador,
                'puesto' => $this->puesto,
                'area' => $this->area,
                'fase' => $this->fase,
                'vigencia_contrato' => $this->vigencia_contrato,
                'fecha_inicio' => $this->fecha_inicio,
                'fecha_fin' => $this->fecha_fin,
                'area_id' => $this->area_id,
                'fecha_firma' => $this->fecha_firma,
                'no_pagos' => $this->no_pagos,
                'tipo_cambio' => $this->tipo_cambio,
                'monto_pago' => $monto_pago,
                'minimo' => $minimo,
                'maximo' => $maximo,
                'razon_soc_id' => $this->razon_soc_id,
                'pmp_asignado' => $this->pmp_asignado,
                'administrador_contrato' => $this->administrador_contrato,
                'folio' => $this->folio,
            ]);

            $proyecto = TimesheetProyecto::select('id', 'identificador')->where('identificador', $this->no_proyecto)->first();

            $convergencia = ConvergenciaContratos::where('contrato_id', $this->contrato->id)->first();

            if (isset($convergencia)) {
                $convergencia->update([
                    'timesheet_proyecto_id' => $proyecto->id,
                    'timesheet_cliente_id' => $this->proveedor_id,
                ]);
            }

            // Actualizar los datos en dólares
            DolaresContrato::updateOrCreate(
                ['contrato_id' => $this->contrato->id],
                [
                    'monto_dolares' => $monto_dolares,
                    'maximo_dolares' => $maximo_dolares,
                    'minimo_dolares' => $minimo_dolares,
                    'valor_dolar' => $this->valor_dolar,
                ]
            );

            // Manejo de archivos
            if ($this->file_contrato) {
                $storagePath = 'public/contratos/' . $this->contrato->id . '_contrato_' . $this->contrato->no_contrato;
                $nombre_f = $this->contrato->id . $this->fecha_inicio . $this->file_contrato->getClientOriginalName();
                $this->file_contrato->storeAs($storagePath, $nombre_f);
                $this->contrato->update(['file_contrato' => $nombre_f]);

                $output = ob_get_contents();
            }

            // Limpiar el buffer sin enviar la salida al navegador
            ob_end_clean();

            if ($this->documento) {
                $storagePath = 'public/contratos/' . $this->contrato->id . '_contrato_' . $this->contrato->no_contrato . '/penalizaciones';
                $nombre_f = $this->contrato->id . $this->fecha_inicio . $this->documento->getClientOriginalName();
                $this->documento->storeAs($storagePath, $nombre_f);
                $this->contrato->update(['documento' => $nombre_f]);
            }

            // Emitir evento de actualización
            // event(new ContratoEvent($this->contrato, 'update', 'contratos', 'Contratos'));

            // Notificar éxito
            $this->alert('success', 'Contrato actualizado correctamente.', [
                'position' => 'center',
                'timer' => 5000,
                'toast' => true,
                'text' => 'Modificado con éxito',
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            $output = ob_get_contents();

            // Limpiar el buffer
            ob_end_clean();
            $this->alert('error', 'Error al actualizar contrato', [
                'position' => 'center',
                'timer' => 5000,
                'toast' => true,
                'text' => $th,
            ]);
        }
    }

    public function changeTipoCambio($value)
    {
        $this->tipo_cambio = $value;
        if ($value != 'MXN') {
            $this->moneda_extranjera = true;
            $convertedAmount = CurrencyConverter::convert(1.0)
                ->from($value)
                ->to('MXN') // you don't need to specify the to method if you want to convert all currencies
                ->format();

            $this->valor_dolar = floatval($convertedAmount);
        } else {
            $this->moneda_extranjera = false;
            $this->valor_dolar = 0;
            $this->edit_moneda = false;
        }
    }

    public function actualizarMontos()
    {
        $monto_pago = $this->monto_pago; // Asumiendo que estos valores se definen en el componente
        $maximo = $this->maximo;
        $minimo = $this->minimo;

        $this->dispatch('actualizarValores', [
            'monto_pago' => $monto_pago,
            'maximo' => $maximo,
            'minimo' => $minimo,
        ]);
    }

    public function updatedEditMoneda($bool)
    {
        // dd($bool);
        if (! $bool) {
            $convertedAmount = CurrencyConverter::convert(1.0)
                ->from($this->tipo_cambio)
                ->to('MXN') // you don't need to specify the to method if you want to convert all currencies
                ->format();

            $this->valor_dolar = floatval($convertedAmount);

            $this->valorManual($this->valor_dolar);
        } else {
            $this->valorManual($this->valor_dolar);
        }
    }

    public function valorManual($val)
    {
        $valor = floatval($val);

        $this->valor_dolar = $val;

        // Usa bcmul para multiplicar la cantidad por la tasa de cambio con 2 decimales
        $this->monto_pago = bcmul($valor, (floatval($this->monto_dolares)), 2);

        $this->maximo = bcmul($valor, (floatval($this->maximo_dolares)), 2);

        $this->minimo = bcmul($valor, (floatval($this->minimo_dolares)), 2);

        $this->actualizarMontos();
    }

    public function convertirME($valor, $tipo)
    {
        if ($this->edit_moneda) {
            $convertirDolares = $this->valor_dolar;
        } else {
            $convertirDolares = CurrencyConverter::convert(1)
                ->from($this->tipo_cambio)
                ->to('MXN') // you don't need to specify the to method if you want to convert all currencies
                ->format();
        }

        $conversion = floor(bcmul(floatval($convertirDolares), floatval($valor), 2) * 100) / 100;
        $conversion = number_format($conversion, 2, '.', '');

        switch ($tipo) {
            case 'monto':
                // code...
                $this->monto_dolares = $valor;
                // $this->monto_pago = floatval($convertirDolares);
                $this->monto_pago = $conversion;
                break;

            case 'maximo':
                // code...
                $this->maximo_dolares = $valor;
                // $this->maximo = floatval($convertirDolares);
                $this->maximo = $conversion;
                break;

            case 'minimo':
                // code...
                $this->minimo_dolares = $valor;
                // $this->minimo = floatval($convertirDolares);
                $this->minimo = $conversion;
                break;

            default:
                // code...
                break;
        }

        $this->actualizarMontos();
    }

}
