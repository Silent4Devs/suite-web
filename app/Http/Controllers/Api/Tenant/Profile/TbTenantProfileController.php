<?php

namespace App\Http\Controllers\Api\Tenant\Profile;

use App\Http\Controllers\Api\Tenant\TbTenantBaseController;
use App\Services\Tenant\TBTenantStripeService;
use App\Services\Tenant\TBTenantTenantManager;
use Illuminate\Http\Request;

class TbTenantProfileController extends TbTenantBaseController
{
    protected $tbTenantManager;

    protected $tbStripeService;

    public function __construct(TBTenantTenantManager $tbTenantManager, TBTenantStripeService $tbStripeService)
    {
        $this->tbTenantManager = $tbTenantManager;
        $this->tbStripeService = $tbStripeService;
    }

    public function tbGetCostumerInfo(Request $request)
    {
        try {
            $tbStripeId = 'cus_RB6jvmea5u8gkC';
            $tbProfile = $this->tbStripeService->tbGetCustomerById($tbStripeId);

            return $this->tbSendResponse($tbProfile, 'Perfil correcto');
        } catch (\Exception $e) {
            return $this->tbSendError($e, ['error' => $e]);
        }
    }

    public function tbGetCostumerSubscriptions(Request $request)
    {
        try {
            $tbStripeId = 'cus_RB6jvmea5u8gkC';
            $tbSuscriptions = $this->tbStripeService->tbGetCustomerSubscriptions($tbStripeId);

            return $this->tbSendResponse($tbSuscriptions, 'Suscripciones encontradas');
        } catch (\Exception $e) {
            return $this->tbSendError($e, ['error' => $e]);
        }
    }
}
