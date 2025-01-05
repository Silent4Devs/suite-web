<?php

namespace App\Http\Controllers\Api\Tenant\Utilities;

use App\Http\Controllers\Api\Tenant\TbTenantBaseController;
use App\Services\Tenant\TBTenantStripeService;
use App\Services\Tenant\TBTenantTenantManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TbTenantUtilities extends TbTenantBaseController
{
    /**
     * tbValidateCardNumber
     *
     * Valida el dato proporcionado respecto al numero de tarjeta de credito,
     * este debe contener entre 13 y 19 digitos y deben ser numeros.
     *
     * @param string $tbCardNumber Dato proporcionado para validar respecto al numero de tarjeta de credito.
     * @return bool/string Respuesta true en caso de ser valido,
     *  y envía un mensaje especificando el error en caso de no ser valido.
     */
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

    /**
     * tbValidateExpirationMonth
     *
     * Valida el dato proporcionado respecto al mes de expiración,
     * este debe ser un numero entero y encontrarse entre el 1-12 respectivo a los meses del año.
     *
     * @param int $tbExpirationMonth Dato proporcionado para validar respecto al mes de expiración.
     * @return bool/string Respuesta true en caso de ser valido,
     *  y envía un mensaje especificando el error en caso de no ser valido.
     */
    public function tbValidateExpirationMonth(int $tbExpirationMonth)
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

    /**
     * tbValidateExpirationYear
     *
     * Valida el dato proporcionado respecto al año de expiración,
     * este debe ser un numero entero y debe ser mayor al año actual.
     *
     * @param int $tbExpirationYear Dato proporcionado para validar respecto al año de expiración.
     * @return bool/string Respuesta true en caso de ser valido,
     *  y envía un mensaje especificando el error en caso de no ser valido.
     */
    public function tbValidateExpirationYear(int $tbExpirationYear)
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

    /**
     * tbValidateExpirationDate
     *
     * Valida en conjunto los datos proporcionados respecto a la fecha de expiración y determina si esta es valida
     *
     * @param int $tbExpirationMonth Dato proporcionado para validar respecto al mes de expiración.
     * @param int $tbExpirationYear Dato proporcionado para validar respecto al año de expiración.
     * @return bool/string Respuesta true en caso de ser valido,
     *  y envía un mensaje especificando el error en caso de no ser valido.
     */
    public function tbValidateExpirationDate(int $tbExpirationMonth, int $tbExpirationYear)
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

    /**
     * tbValidateCVC
     *
     * Valida el dato CVC de la tarjeta de credito,
     * este debe contener un total de 3 caracteres y estos deben ser numericos.
     *
     * @param string $tbCVC Variable que proporciona el CVC.
     * @return bool/string Respuesta true en caso de ser valido,
     *  y envía un mensaje especificando el error en caso de no ser valido.
     */
    public function tbValidateCVC(string $tbCVC)
    {
        // Paso 1: Verificar si el string tiene exactamente 3 caracteres
        if (strlen($tbCVC) !== 3) {
            return 'El dato proporcionado debe contener solo 3 caracteres.';
        }

        // Paso 2: Verificar si el string contiene solo números
        if (!preg_match('/^\d{3}$/', $tbCVC)) {
            return 'Valor invalido. Ingrese nuevamente su CVC';
        }

        // Si pasa todas las validaciones
        return true;
    }

    /**
     * tbValidateAddress
     *
     * Valida los datos obtenidos para ingresar una dirección, a excepción de la line 2 que puede ser opcional
     * todos son obligatorios:
     * line1 corresponde a la calle del domicilio y debe ser alfanumerico.
     * line2 sirve como complemento o referencia respecto a la dirección, numero interior, etc...
     * city corresponde a la ciudad debe ser alfanumerico.
     * state corresponde al estado debe ser alfanumerico.
     * postal_code corresponde al codigo postal y debe contener solo numeros.
     * country corresponde al país y debe ser un código ISO 3166-1 de 2 letras.
     *
     * @param array $tbAddress es el arreglo que contiene la información de direccion.
     * @return array Respuesta un array que contiene los errores encontrados al validar los datos,
     * en caso de estar vacio se tomara como que se validaron correctamente los datos.
     */
    public function tbValidateAddress(array $tbAddress)
    {
        $errors = [];

        // Validar line1 (obligatorio, alfanumérico).
        if (empty($tbAddress['line1']) || !preg_match('/^[a-zA-Z0-9\s\-\,\.]+$/', $tbAddress['line1'])) {
            $errors['line1'] = 'La línea 1 es obligatoria y debe ser alfanumérica.';
        }

        // Validar line2 (opcional, alfanumérico).
        if (isset($tbAddress['line2']) && !preg_match('/^[a-zA-Z0-9\s\-\,\.]*$/', $tbAddress['line2'])) {
            $errors['line2'] = 'La línea 2 debe ser alfanumérica si se proporciona.';
        }

        // Validar city (obligatorio, alfanumérico).
        if (empty($tbAddress['city']) || !preg_match('/^[a-zA-Z0-9\s\-]+$/', $tbAddress['city'])) {
            $errors['city'] = 'La ciudad es obligatoria y debe ser alfanumérica.';
        }

        // Validar state (obligatorio, alfanumérico).
        if (empty($tbAddress['state']) || !preg_match('/^[a-zA-Z0-9\s\-]+$/', $tbAddress['state'])) {
            $errors['state'] = 'El estado es obligatorio y debe ser alfanumérico.';
        }

        // Validar postal_code (obligatorio, solo números).
        if (empty($tbAddress['postal_code']) || !preg_match('/^\d+$/', $tbAddress['postal_code'])) {
            $errors['postal_code'] = 'El código postal es obligatorio y debe contener solo números.';
        }

        // Validar country (obligatorio, longitud fija de 2 caracteres).
        if (empty($tbAddress['country']) || strlen($tbAddress['country']) !== 2 || !preg_match('/^[A-Z]{2}$/', $tbAddress['country'])) {
            $errors['country'] = 'El país es obligatorio y debe ser un código ISO 3166-1 de 2 letras.';
        }

        return $errors; // Devolvemos un arreglo con los errores.
    }

}
