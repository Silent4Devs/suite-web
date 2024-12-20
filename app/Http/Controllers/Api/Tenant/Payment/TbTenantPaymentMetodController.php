<?php

namespace App\Http\Controllers\Api\Tenant\Payment;

use App\Http\Controllers\Api\Tenant\TbTenantBaseController;
use App\Services\Tenant\TBTenantStripeService;
use App\Services\Tenant\TBTenantTenantManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TbTenantPaymentMetodController extends TbTenantBaseController
{

    protected $tbTenantManager;

    protected $tbStripeService;

    public function __construct(TBTenantTenantManager $tbTenantManager, TBTenantStripeService $tbStripeService)
    {
        $this->tbTenantManager = $tbTenantManager;
        $this->tbStripeService = $tbStripeService;
    }

    public function tbGetPaymentMethod(Request $request)
    {
        try {
            $tbStripeId = 'cus_RB6jvmea5u8gkC'; //costomerId
            $tbPayment = $this->tbStripeService->tbGetSavedCards($tbStripeId);

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
            $tbPaymentId =  'card_1QQa2ELyj74Bldhk1lqfe0JN';
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
}
