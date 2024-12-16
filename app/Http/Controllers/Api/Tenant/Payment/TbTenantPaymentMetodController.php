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

    // public function tbAddPaymentMethod(Request $request)
    // {
    //     try {
    //         $tbStripeId = 'cus_RB6jvmea5u8gkC'; //costomerId
    //         $tbPayment = $this->tbStripeService->tbAddPaymentMethod($tbStripeId, 'card');

    //         return $this->tbSendResponse($tbPayment, 'Metodo de pago removido correctamente.');
    //     } catch (\Exception $e) {
    //         return $this->tbSendError($e, ['error' => $e]);
    //     }
    // }

    // public function tbRemovePaymentMethod(Request $request)
    // {
    //     try {
    //         $tbStripeId = 'cus_RB6jvmea5u8gkC'; //costomerId
    //         $tbPayment = $this->tbStripeService->tbRemovePaymentMethod($tbStripeId);

    //         return $this->tbSendResponse($tbPayment, 'Metodo de pago removido correctamente.');
    //     } catch (\Exception $e) {
    //         dd($e);
    //         return $this->tbSendError($e, ['error' => $e]);
    //     }
    // }

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
