<?php

namespace App\Http\Controllers\Api\Tenant\Payment;

use App\Http\Controllers\Api\Tenant\TbTenantBaseController;
use App\Http\Controllers\Api\Tenant\Utilities\TbTenantUtilities;
use App\Services\Tenant\TBTenantStripeService;
use App\Services\Tenant\TBTenantTenantManager;
use Illuminate\Http\Request;

class TbTenantPaymentMetodController extends TbTenantBaseController
{
    protected $tbTenantManager;

    protected $tbStripeService;

    protected $tbTenantUtilities;

    public function __construct(TBTenantTenantManager $tbTenantManager, TBTenantStripeService $tbStripeService, TbTenantUtilities $tbTenantUtilities)
    {
        $this->tbTenantManager = $tbTenantManager;
        $this->tbStripeService = $tbStripeService;
        $this->tbTenantUtilities = $tbTenantUtilities;
    }

    public function tbGetPaymentMethod(Request $request)
    {
        try {
            $tbCustomerId = $request->customerId;
            $tbPayment = $this->tbStripeService->tbGetSavedCards($tbCustomerId);

            return $this->tbSendResponse($tbPayment, 'Metodos de pagos correcto.');
        } catch (\Exception $e) {
            return $this->tbSendError($e, ['error' => $e]);
        }
    }

    public function tbAddPaymentMethod(Request $request)
    {
        try {
            //$tbStripeId = 'cus_RB6jvmea5u8gkC';
            $tbStripeId = 'cus_RABmnSCQX7qE8h'; //costumerId $tbStripeId
            $tbPaymentId = 'card_1QQa2ELyj74Bldhk1lqfe0JN';
            // $tbPaymentId = 'pm_1PZ8wJLyj74BldhkpOzeyWPs';

            $tbPayment = $this->tbStripeService->tbAddPaymentMethod($tbStripeId, $tbPaymentId);

            return $this->tbSendResponse($tbPayment, 'Metodo de pago agregado y vinculado correctamente.');
        } catch (\Exception $e) {
            return $this->tbSendError($e, ['error' => $e]);
        }
    }

    public function tbAddCardPaymentMethod(Request $request)
    {
        try {
            $tbStripeId = 'cus_RB6jvmea5u8gkC'; //costumerId $tbStripeId

            // Inicializar un arreglo para almacenar errores
            $errors = [];

            // Validar cada campo y almacenar el error si existe
            $validationCardNumber = $this->tbTenantUtilities->tbValidateCardNumber($request['card_number']);
            if ($validationCardNumber !== true) {
                $errors['card_number'] = $validationCardNumber;
            }

            $validationExpirationMonth = $this->tbTenantUtilities->tbValidateExpirationMonth($request['expiration_month']);
            if ($validationExpirationMonth !== true) {
                $errors['expiration_month'] = $validationExpirationMonth;
            }

            $validationExpirationYear = $this->tbTenantUtilities->tbValidateExpirationYear($request['expiration_year']);
            if ($validationExpirationYear !== true) {
                $errors['expiration_year'] = $validationExpirationYear;
            }

            $validationDate = $this->tbTenantUtilities->tbValidateExpirationDate($request['expiration_month'], $request['expiration_year']);
            if ($validationDate !== true) {
                $errors['expiration_date'] = $validationDate;
            }

            $validationCVC = $this->tbTenantUtilities->tbValidateCVC($request['cvc']);
            if ($validationCVC !== true) {
                $errors['cvc'] = $validationCVC;
            }

            // Verificar si hay errores
            if (! empty($errors)) {
                // Retornar los errores
                return $this->tbSendError('Validation failed', ['errors' => $errors]);
            }

            // Si no hay errores, proceder con la lógica adicional
            $tbPayment = $this->tbStripeService->tbAddCard($tbStripeId, $request['card_number'], $request['expiration_month'], $request['expiration_year'], $request['cvc']);

            return $this->tbSendResponse($tbPayment, 'Metodo de pago agregado y vinculado correctamente.');
        } catch (\Exception $e) {
            return $this->tbSendError($e, ['error' => $e]);
        }
    }

    public function tbRemovePaymentMethod(Request $request)
    {
        try {
            $tbPaymentId = 'pm_1PZ98cLyj74BldhkuDritGlQ';
            // $tbPaymentId = 'card_1QQa6eLyj74BldhkqErgGNFG'; //paymentId
            $tbPayment = $this->tbStripeService->tbRemovePaymentMethod($tbPaymentId);

            return $this->tbSendResponse($tbPayment, 'Metodo de pago removido correctamente.');
        } catch (\Exception $e) {
            return $this->tbSendError($e, ['error' => $e]);
        }
    }

    public function tbGetBillingAddressMethod(Request $request)
    {
        try {
            $tbStripeId = 'cus_RB6jvmea5u8gkC'; //costomerId
            $tbBillingAddress = $this->tbStripeService->tbGetBillingAddress($tbStripeId);

            return $this->tbSendResponse($tbBillingAddress, 'Dirección de Factura obtenida con éxito.');
        } catch (\Exception $e) {
            return $this->tbSendError($e, ['error' => $e]);
        }
    }

    public function tbAddBillingAddressMethod(Request $request)
    {
        try {
            $tbStripeId = 'cus_RB6jvmea5u8gkC'; // Customer ID

            // Obtenemos la dirección del request
            $data = $request->input('address'); // Address contiene la información del formulario
            $billingAddress = collect($data)->toArray();

            // Validamos la dirección utilizando tbValidateAddress
            $addressValidation = $this->tbTenantUtilities->tbValidateAddress($billingAddress);

            if (! empty($addressValidation)) {
                // Enviamos los errores si la validación falla
                return $this->tbSendError(
                    'Ha habido un error al validar la dirección de facturación',
                    ['errors' => $addressValidation],
                    422
                );
            }

            // Si pasa la validación, llamamos al servicio para agregar la dirección
            $tbAddBillingAddress = $this->tbStripeService->tbAddBillingAddress($tbStripeId, $billingAddress);

            return $this->tbSendResponse($tbAddBillingAddress, 'Dirección de factura agregada exitosamente');
        } catch (\Exception $e) {
            // Manejo de excepciones
            return $this->tbSendError('Ha ocurrido un error inesperado', ['error' => $e->getMessage()], 500);
        }
    }

    public function tbUpdateBillingAddressMethod(Request $request)
    {
        try {
            $tbStripeId = 'cus_RB6jvmea5u8gkC'; // Customer ID

            // Obtenemos la dirección del request
            $data = $request->input('address'); // Address contiene la información del formulario
            $billingAddress = collect($data)->toArray();

            // Validamos la dirección utilizando tbValidateAddress
            $addressValidation = $this->tbTenantUtilities->tbValidateAddress($billingAddress);

            if (! empty($addressValidation)) {
                // Enviamos los errores si la validación falla
                return $this->tbSendError(
                    'Ha habido un error al validar la dirección de facturación',
                    ['errors' => $addressValidation],
                    422
                );
            }

            // Si pasa la validación, llamamos al servicio para agregar la dirección
            $tbAddBillingAddress = $this->tbStripeService->tbAddBillingAddress($tbStripeId, $billingAddress);

            return $this->tbSendResponse($tbAddBillingAddress, 'Dirección de factura modificada exitosamente');
        } catch (\Exception $e) {
            // Manejo de excepciones
            return $this->tbSendError('Ha ocurrido un error inesperado', ['error' => $e->getMessage()], 500);
        }
    }

    public function tbRemoveBillingAddressMethod(Request $request)
    {
        try {
            $tbStripeId = 'cus_RB6jvmea5u8gkC'; // Customer ID

            $tbRemoveBillingAddress = $this->tbStripeService->tbRemoveBillingAddress($tbStripeId);
            // tbRemoveBillingAddress(string $tbCustomerId)

            return $this->tbSendResponse($tbRemoveBillingAddress, 'Dirección de factura removida exitosamente');
        } catch (\Exception $e) {
            // Manejo de excepciones
            return $this->tbSendError('Ha ocurrido un error inesperado', ['error' => $e->getMessage()], 500);
        }
    }

    public function createSubscriptionForMultipleProducts(Request $request)
    {
        try {
            $tbCustomerId = $request->customerId;
            $productPriceIds = $request->productPriceIds; // Customer ID

            $tbCreateSubcription = $this->tbStripeService->createSubscriptionForMultipleProducts($tbCustomerId, $productPriceIds);

            return $this->tbSendResponse($tbCreateSubcription, 'Pago correcto');
        } catch (\Exception $e) {
            // Manejo de excepciones
            return $this->tbSendError('Ha ocurrido un error inesperado', ['error' => $e->getMessage()], 500);
        }
    }
}
