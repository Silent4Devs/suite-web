<?php

namespace App\Http\Controllers\Api\Tenant\History;

use App\Http\Controllers\Api\Tenant\TbTenantBaseController;
use App\Services\Tenant\TBTenantStripeService;
use App\Services\Tenant\TBTenantTenantManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TbTenantHistoryController extends TbTenantBaseController
{

    protected $tbTenantManager;

    protected $tbStripeService;

    public function __construct(TBTenantTenantManager $tbTenantManager, TBTenantStripeService $tbStripeService)
    {
        $this->tbTenantManager = $tbTenantManager;
        $this->tbStripeService = $tbStripeService;
    }

    public function tbGetHistory(Request $request)
    {
        try {
            $tbCustomerId = $request->customerId;
            $tbHistory = $this->tbStripeService->tbGetPurchaseHistory($tbCustomerId);

            return $this->tbSendResponse($tbHistory, 'Historial correcto');
        } catch (\Exception $e) {
            return $this->tbSendError($e, ['error' => $e]);
        }
    }
}
