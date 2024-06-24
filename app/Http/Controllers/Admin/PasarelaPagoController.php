<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plan;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Laravel\Cashier\Cashier;
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

        $all_plans = $stripe->prices->all(['limit' => 100]);

        $subscribed_plans = [];
        $unsubscribed_plans = [];

        foreach ($all_plans->data as $plan) {
            if (in_array($plan->id, $subscribed_plan_ids)) {
                $subscribed_plans[] = $plan;
            } else {
                $unsubscribed_plans[] = $plan;
            }
        }

        foreach ($subscribed_plans as $plan) {
            $productDetail = $stripe->products->retrieve($plan->product, []);

            Plan::updateOrCreate(
                ['stripe_plan' => $plan->id],
                [
                    'name' => $productDetail->name,
                    'slug' => $productDetail->metadata->slug ?? "",
                    'description' => $productDetail->description,
                    'subscription' => true,
                    'price' => $plan->unit_amount / 100,  // El precio se almacena en centavos, así que divídelo por 100
                    'interval' => $plan->recurring->interval,
                    'trial_period_days' => $plan->recurring->trial_period_days ?? null,
                    'currency' => $plan->currency,
                    'dias' => $plan->metadata->dias ?? null,  // Asumiendo que 'dias' está en los metadatos del plan
                    'img' => $productDetail->metadata->img ?? null,
                ]
            );
        }
        // Guardar los unsubscribed_plans
        foreach ($unsubscribed_plans as $plan) {
            $productDetail = $stripe->products->retrieve($plan->product, []);

            Plan::updateOrCreate(
                ['stripe_plan' => $plan->id],
                [
                    'name' => $productDetail->name,
                    'slug' => $productDetail->metadata->slug ?? "",
                    'description' => $productDetail->description,
                    'subscription' => false,
                    'price' => $plan->unit_amount / 100,  // El precio se almacena en centavos, así que divídelo por 100
                    'interval' => $plan->recurring->interval,
                    'trial_period_days' => $plan->recurring->trial_period_days ?? null,
                    'currency' => $plan->currency,
                    'dias' => $plan->metadata->dias ?? null,  // Asumiendo que 'dias' está en los metadatos del plan
                    'img' => $productDetail->metadata->img ?? null,
                ]
            );
        }
        $db_subscribed_plans = Plan::where('subscription', true)->get();
        return view('admin.pasarelaPago.inicio-servicios', compact('db_subscribed_plans', 'unsubscribed_plans'));
    }

    public function planesPrecios(Request $request)
    {
        return view('admin.pasarelaPago.planes-precios');
    }

    public function prePago(Request $request)
    {
        $unsubscribed_plans = [];
        $db_unsubscribed_plans = Plan::where('subscription', false)->get();
        foreach ($db_unsubscribed_plans as $db_plan) {
            $unsubscribed_plans[] = $db_plan;
        }
        return view('admin.pasarelaPago.pre-pago', compact("unsubscribed_plans"));
    }

    public function pago(Plan $plan, Request $request)
    {
        $jsonString = $request->input('arrayData');
        $data = json_decode($jsonString, true);
        $intent = auth()->user()->createSetupIntent();
        return view('admin.pasarelaPago.pago', compact("plan", "intent", "data"));
    }

    public function subscription(Request $request)
    {
        $stripe = new StripeClient(env('STRIPE_SECRET'));
        $plans = json_decode($request->plan, true);

        foreach ($plans as $plan) {
            $planId = $plan['id'];
            $planName = $plan['name'];
            $planFromDatabase = Plan::where('stripe_plan', $planId)->first();
            $subscription = $request->user()->newSubscription($plan['id'], $planFromDatabase->stripe_plan)->create($request->token);
        }
        return view("admin.pasarelaPago.pago-confirmado");
    }

    public function pagoConfirmado()
    {
        dd("hola");
        return view('admin.pasarelaPago.pago-confirmado');
    }

    public function createPaymentIntent(Request $request)
    {
        try {
            // Obtener el producto y el precio de Stripe
            $productId = 'your_product_id'; // ID del producto en Stripe
            $priceId = 'your_price_id'; // ID del precio en Stripe

            // Crear el intento de pago con Stripe
            $paymentIntent = Cashier::stripe()->paymentIntents()->create([
                'amount' => 1000, // El monto en centavos (por ejemplo, $10.00)
                'currency' => 'usd',
                'payment_method_types' => ['card', 'paypal', 'mercado_pago'],
                'customer' => $request->user()->stripe_id,
                'metadata' => [
                    'product_id' => $productId,
                    'price_id' => $priceId,
                ],
            ]);

            // Confirmar el intento de pago
            Cashier::stripe()->paymentIntents()->confirm(
                $paymentIntent->id,
                ['payment_method' => $request->input('payment_method')]
            );

            // Si se proporciona un plan, crear la suscripción
            if ($request->has('plan_id')) {
                $planId = $request->input('plan_id');
                $user = $request->user();

                // Crear la suscripción utilizando Laravel Cashier
                $subscription = $user->newSubscription($planId, 'default_plan')->create($request->token);

                // Opcional: Guardar el método de pago
                if ($request->input('save_payment_method')) {
                    $user->updateDefaultPaymentMethod($request->input('payment_method_id'));
                }
            }

            return response()->json([
                'clientSecret' => $paymentIntent->client_secret,
            ]);

        } catch (CardException $e) {
            // Manejar excepción si ocurre un problema con la tarjeta de crédito
            return response()->json(['error' => $e->getMessage()], 422);
        } catch (\Exception $e) {
            // Manejar otras excepciones generales
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
