<?php

namespace App\Livewire;

use App\Models\ContractManager\Contrato;
use Livewire\Component;
use Mgcodeur\CurrencyConverter\Facades\CurrencyConverter;

class MonedaExtContratosEdit extends Component
{
    public $divisas;

    public $tipo_cambio = '';

    public $valor_dolar = 0;

    public $moneda_extranjera = false;

    public $edit_moneda = false;

    public $monto_dolares = 0;

    public $maximo_dolares = 0;

    public $minimo_dolares = 0;

    public $monto_pago = 0;

    public $maximo = 0;

    public $minimo = 0;

    public function mount($id_contrato)
    {
        // $currencies = CurrencyConverter::currencies()->get();

        $contratos = Contrato::where('id', $id_contrato)->first();
        // dd($contratos);

        if (! empty($contratos->dolares)) {
            // code...
            $this->moneda_extranjera = true;

            $this->tipo_cambio = $contratos->tipo_cambio;

            $this->valor_dolar = $contratos->dolares->valor_dolar ?? 0;

            $this->monto_dolares = $contratos->dolares->monto_dolares;
            $this->maximo_dolares = $contratos->dolares->maximo_dolares ?? 0;
            $this->minimo_dolares = $contratos->dolares->minimo_dolares ?? 0;
        }

        $this->monto_pago = $contratos->monto_pago;
        $this->maximo = $contratos->maximo;
        $this->minimo = $contratos->minimo;

        $this->divisas = [
            'MXN',
            'USD',
        ];

        // $this->divisas = [
        //     '0' => 'MXN',
        //     '1' => 'USD',
        //     '2' => 'EUR',
        //     '3' => 'GBP',
        //     '4' => 'CHF',
        //     '5' => 'JPY',
        //     '6' => 'HKD',
        //     '7' => 'CAD',
        //     '8' => 'CNY',
        //     '9' => 'AUD',
        //     '10' => 'BRL',
        //     '11' => 'RUB',
        // ];
    }

    public function render()
    {
        return view('livewire.moneda-ext-contratos-edit');
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

        $this->monto_pago = (floatval($this->monto_dolares) * $valor);

        $this->maximo = (floatval($this->maximo_dolares) * $valor);

        $this->minimo = (floatval($this->minimo_dolares) * $valor);

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

        $conversion = floor(floatval($convertirDolares) * floatval($valor) * 100) / 100;
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
