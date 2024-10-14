<?php

namespace App\Livewire;

use Livewire\Component;
use Mgcodeur\CurrencyConverter\Facades\CurrencyConverter;

class MonedaExtContratosCreate extends Component
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

    public function mount(){
        // $currencies = CurrencyConverter::currencies()->get();

        // convert 5 EUR to all currencies
        // $convertedAmount = CurrencyConverter::convert(5)
        //             ->from('EUR')
        //             ->get();

        $this->divisas = [
            'MXN',
            'USD'
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
        return view('livewire.moneda-ext-contratos-create');
    }

    public function updatedTipoCambio($value)
    {
        if($value != 'MXN')
        {
            $this->moneda_extranjera = true;
            $convertedAmount = CurrencyConverter::convert(1.0)
            ->from($value)
            ->to('MXN') // you don't need to specify the to method if you want to convert all currencies
            ->format();

            $this->valor_dolar = floatval($convertedAmount);
        }else{
            $this->moneda_extranjera = false;
            $this->valor_dolar = 0;
            $this->edit_moneda = false;
        }
    }

    public function updatedEditMoneda($bool)
    {
        // dd($bool);
        if(!$bool)
        {
            $convertedAmount = CurrencyConverter::convert(1.0)
            ->from($this->tipo_cambio)
            ->to('MXN') // you don't need to specify the to method if you want to convert all currencies
            ->format();

            $this->valor_dolar = floatval($convertedAmount);

            $this->valorManual($this->valor_dolar);

        }
    }

    public function valorManual($val)
    {
        $valor = floatval($val);

        $this->monto_pago = (floatval($this->monto_dolares) * $valor);

        $this->maximo = (floatval($this->maximo_dolares) * $valor);

        $this->minimo = (floatval($this->minimo_dolares) * $valor);
    }

    public function convertirME($valor, $tipo)
    {
        // dump($valor);
        $convertirDolares = CurrencyConverter::convert(floatval($valor))
        ->from($this->tipo_cambio)
        ->to('MXN') // you don't need to specify the to method if you want to convert all currencies
        ->format();

        // dd($convertirDolares);

        switch ($tipo) {
            case 'monto':
                # code...
                $this->monto_dolares = $valor;
                $this->monto_pago = floatval($convertirDolares);
                break;

            case 'maximo':
                # code...
                $this->maximo_dolares = $valor;
                $this->maximo = floatval($convertirDolares);
                break;

            case 'minimo':
                # code...
                $this->minimo_dolares = $valor;
                $this->minimo = floatval($convertirDolares);
                break;

            default:
                # code...
                break;
        }

    }
}
