<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plan;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Stripe\StripeClient;

class PasarelaPagoController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.pasarelaPago.inicio-servicios');
    }

    public function planesPrecios(Request $request)
    {
        $user = $request->user();

        $stripe = new StripeClient(env('STRIPE_SECRET'));

        $subscriptions = $user->subscriptions;
        //dd($subscriptions);
        $subscription = $stripe->subscriptions->retrieve(
            $subscriptions[0]->stripe_id
        );

        if ($subscription->status === 'activa') {

        } else {

        }

        $plans = Plan::get();
        // dd($plans);
        return view('admin.pasarelaPago.planes-precios', compact("plans"));
    }

    public function prePago(Request $request)
    {

        return view('admin.pasarelaPago.pre-pago');
    }

    public function pago(Plan $plan, Request $request)
    {
        $intent = auth()->user()->createSetupIntent();
        return view('admin.pasarelaPago.pago', compact("plan", "intent"));
    }

    public function subscription(Request $request)
    {

        $plan = Plan::find($request->plan);
        $subscription = $request->user()->newSubscription($request->plan, $plan->stripe_plan)->create($request->token);
        return view("subscription_success");
    }
}
