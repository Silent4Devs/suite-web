<?php

namespace App\Http\Controllers\Api\Tenant\Product;

use App\Http\Controllers\Api\Tenant\TbTenantBaseController;
use App\Services\Tenant\TBTenantStripeService;
use App\Services\Tenant\TBTenantTenantManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TbTenantProductMetodController extends TbTenantBaseController
{
    protected $tbTenantManager;

    protected $tbStripeService;

    public function __construct(TBTenantTenantManager $tbTenantManager, TBTenantStripeService $tbStripeService)
    {
        $this->tbTenantManager = $tbTenantManager;
        $this->tbStripeService = $tbStripeService;
    }

    public function tbGetProductMethod(Request $request)
    {
        try {

            $tbIdProduct = "prod_QJoDHqbaelALBQ";

            $tbProduct = $this->tbStripeService->tbGetProductDetailsById($tbIdProduct);

            return $this->tbSendResponse($tbProduct, 'Metodos de pagos correcto.');
        } catch (\Exception $e) {
            dd($e);
            return $this->tbSendError($e, ['error' => $e]);
        }
    }
}
