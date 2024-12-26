<?php

namespace App\Http\Controllers\Api\Tenant\Utilities;

use App\Http\Controllers\Api\Tenant\TbTenantBaseController;
use App\Services\Tenant\TBTenantStripeService;
use App\Services\Tenant\TBTenantTenantManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TbTenantUtilities extends TbTenantBaseController
{
    public function tbValidateCardNumber(string $tbCardNumber)
    {
        if (strlen($tbCardNumber) < 13 || strlen($tbCardNumber) > 19) {
            return 'La tarjeta de credito debe contener entre 13 y 19 digitos.';
        }

        // Paso 2: Verificar si el string contiene solo números
        if (!preg_match('/^\d+$/', $tbCardNumber)) {
            return 'El numero de tarjeta de credito ingresado no es valido.';
        }

        // Si pasa todas las validaciones
        return true;
    }

    public function tbValidateExpirationMonth($tbExpirationMonth)
    {
        // Verificar si el dato es un entero
        if (!is_int($tbExpirationMonth)) {
            return 'El dato debe ser un número entero.';
        }

        // Verificar si el dato está entre 1 y 12
        if ($tbExpirationMonth < 1 || $tbExpirationMonth > 12) {
            return 'Mes de vencimiento invalido. Por favor ingrese el mes de vencimiento de la tarjeta.';
        }

        // Si pasa la validación
        return true;
    }

    public function tbValidateExpirationYear($tbExpirationYear)
    {
        // Obtener el año actual
        $anoActual = (int)date('Y');

        // Verificar si el dato es un número entero
        if (!is_int($tbExpirationYear)) {
            return 'El año debe ser un número entero.';
        }

        // Verificar si el dato es mayor o igual al año actual
        if ($tbExpirationYear < $anoActual) {
            return 'Año de expiración invalido. Por favor ingrese correctamente el año o una tarjeta valida.';
        }

        // Si pasa la validación
        return true;
    }

    public function tbValidateExpirationDate($tbExpirationMonth, $tbExpirationYear)
    {

        // Obtener el mes y año actual
        $mesActual = (int)date('m');
        $anoActual = (int)date('Y');

        // Verificar si el dato es mayor o igual al año actual
        if ($tbExpirationYear == $anoActual) {
            if($tbExpirationMonth >= $mesActual)
            return 'Fecha de expiración invalida. Por favor ingrese correctamente la fecha o una tarjeta valida.';
        }

        // Si pasa la validación
        return true;
    }

    public function tbValidateCVC($tbCardNumber)
    {
        // Paso 1: Verificar si el string tiene exactamente 3 caracteres
        if (strlen($tbCardNumber) !== 3) {
            return 'El dato proporcionado debe contener solo 3 caracteres.';
        }

        // Paso 2: Verificar si el string contiene solo números
        if (!preg_match('/^\d{3}$/', $tbCardNumber)) {
            return 'Valor invalido. Ingrese nuevamente su CVC';
        }

        // Si pasa todas las validaciones
        return true;
    }
    //esto es un cambio
}
