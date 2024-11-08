<?php

namespace App\Livewire;

use Livewire\Component;
use Mgcodeur\CurrencyConverter\Facades\CurrencyConverter;

class MonedaExtContratosCreate extends Component
{
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

    public function mount()
    {
        // $currencies = CurrencyConverter::currencies()->get();

        // convert 5 EUR to all currencies
        // $convertedAmount = CurrencyConverter::convert(5)
        //             ->from('EUR')
        //             ->get();

        $this->divisas = [
            'MXN',
            'USD',
        ];

        if (session()->get('tipo_cambio', 'MXN') === null) {
            $this->tipo_cambio = "MXN";
        } else {
            session()->put('tipo_cambio', 'MXN');
            $this->tipo_cambio = session()->get('tipo_cambio', 'MXN'); // "MXN" como valor predeterminado
        }

        if ($this->tipo_cambio !== 'MXN') {
            $this->moneda_extranjera = true;
            $this->valor_dolar = CurrencyConverter::convert(1)
                ->from($this->tipo_cambio)
                ->to('MXN')
                ->format();
        }
    }

    public function render()
    {
        return view('livewire.moneda-ext-contratos-create');
    }

    public function changeTipoCambio($value)
    {
        $this->tipo_cambio = $value;
        if ($value != 'MXN') {
            $this->moneda_extranjera = true;
            $convertedAmount = CurrencyConverter::convert(1)
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

    public function actualizarMonExt()
    {
        $valor_dolar = $this->valor_dolar;
        $this->dispatch('actualizarDolares', [
            'valor_dolar' => $valor_dolar,
        ]);
    }

    public function updatedEditMoneda($bool)
    {
        if (! $bool) {
            $convertedAmount = CurrencyConverter::convert(1.0)
                ->from($this->tipo_cambio)
                ->to('MXN') // you don't need to specify the to method if you want to convert all currencies
                ->format();

            $this->valor_dolar = floatval($convertedAmount);
            $this->actualizarMonExt();
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
