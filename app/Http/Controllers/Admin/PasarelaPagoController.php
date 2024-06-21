<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plan;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Stripe\StripeClient;
use Stripe\Plan as StripePlan;

class PasarelaPagoController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $stripe = new StripeClient(env('STRIPE_SECRET'));

        $subscriptions = $user->subscriptions;

        $subscribed_plan_ids = $subscriptions->map(function ($subscription) {
            return $subscription->stripe_price;
        })->toArray();

        $all_plans = $stripe->plans->all(['limit' => 100]);

        $subscribed_plans = [];
        $unsubscribed_plans = [];

        foreach ($all_plans->data as $plan) {
            $productDetail = $stripe->products->retrieve($plan->product, []);
            if (in_array($plan->id, $subscribed_plan_ids)) {
                $subscribed_plans[] = $productDetail;
            } else {
                $unsubscribed_plans[] = $productDetail;
            }
        }
        return view('admin.pasarelaPago.inicio-servicios', compact('subscribed_plans', 'unsubscribed_plans'));
    }

    public function planesPrecios(Request $request)
    {
        // $subscriptions = $user->subscriptions;

        // $subscription = $stripe->subscriptions->retrieve(
        //     $subscriptions[0]->stripe_id
        // );

        // if ($subscription->status === 'activa') {
        // } else {
        // }
        return view('admin.pasarelaPago.planes-precios');
    }

    public function prePago(Request $request)
    {
        $user = $request->user();
        $stripe = new StripeClient(env('STRIPE_SECRET'));
        $plansAlls = $stripe->plans->all();
        foreach ($plansAlls->data as $stripePlan) {
            $productDetail = $stripe->products->retrieve($stripePlan->product, []);
            $plan = Plan::updateOrCreate(
                [
                    'stripe_plan' => $stripePlan->id
                ],
                [
                    'name' => $productDetail->metadata->name ?? 'No name',
                    'slug' => $productDetail->metadata->name,
                    'price' => $stripePlan->amount_decimal,
                    'description' => $productDetail->metadata->description ?? 'No description available',
                ]
            );
        }
        $plans = Plan::get();

        return view('admin.pasarelaPago.pre-pago', compact("plans"));
    }

    public function pago(Plan $plan, Request $request)
    {
        $intent = auth()->user()->createSetupIntent();
        return view('admin.pasarelaPago.pago', compact("plan", "intent"));
    }

    public function subscription(Request $request)
    {

        //$plan = Plan::find($request->plan);
        //$subscription = $request->user()->newSubscription($request->plan, $plan->stripe_plan)->create($request->token);
        return view("subscription_success");
    }

    public function pagoConfirmado()
    {
        return view('admin.pasarelaPago.pago-confirmado');
    }
}
