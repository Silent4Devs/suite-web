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

    public function tbGetPaymentMetod(Request $request)
    {
        try {
            $tbStripeId = 'cus_RB6jvmea5u8gkC'; //costomerId
            $tbHistory = $this->tbStripeService->tbGetSavedCards($tbStripeId);

            return $this->tbSendResponse($tbHistory, 'Metodos de pagos correcto');
        } catch (\Exception $e) {
            return $this->tbSendError($e, ['error' => $e]);
        }
    }
}