<?php

namespace App\Http\Controllers\Api\Tenant\Payment;

use App\Http\Controllers\Api\Tenant\TbTenantBaseController;
use App\Services\Tenant\TBTenantStripeService;
use App\Services\Tenant\TBTenantTenantManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TbTenantUtilities extends TbTenantBaseController
{
    public function tbValidateCardNumber($tbCardNumber)
    {
        dd($tbCardNumber);
    }

    public function tbValidateExpirationMonth($tbCardNumber)
    {
        dd($tbCardNumber);
    }

    public function tbValidateExpirationYear($tbCardNumber)
    {
        dd($tbCardNumber);
    }

    public function tbValidateCVC($tbCardNumber)
    {
        dd($tbCardNumber);
    }
    //esto es un cambio
}
