<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plan;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Laravel\Cashier\Cashier;
use Stripe\Exception\CardException;
use Stripe\PaymentIntent;
use Stripe\PaymentMethod;
use Stripe\StripeClient;
use Stripe\Plan as StripePlan;
use Stripe\Stripe;
use App\Models\Subscription;
use Laravel\Cashier\Exceptions\IncompletePayment;
use Laravel\Cashier\Subscription as CashierSubscription;

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
                $db_plan = Plan::where('stripe_plan', $plan->id)->first();
                $unsubscribed_plans[] = [
                    'id' => $plan->id,
                    'name' => $db_plan->name,
                    'price' => $plan->unit_amount_decimal / 100,
                    'stripe_plan' => $plan->id,
                    'product' => $plan->product,
                    'img' => $db_plan->img,
                ];
            }
        }

        return view('admin.pasarelaPago.pre-pago', compact("unsubscribed_plans"));
    }

    public function pago(Plan $plan, Request $request)
    {
        $stripe = new StripeClient(env('STRIPE_SECRET'));
        $user = $request->user();
        $paymentMethods = $stripe->paymentMethods->all([
            'type' => 'card',
            'limit' => 3,
            'customer' => $user->stripe_id, // ID del cliente en Stripe
        ]);

        $jsonString = $request->input('arrayData');
        $data = json_decode($jsonString, true);
        $totalPrice = 0;
        foreach ($data as $item) {
            if (isset($item['price'])) {
                $totalPrice += $item['price'];
            }
        }
        $totalPriceFormatted = number_format($totalPrice, 2, ',', '.');
        $intent = auth()->user()->createSetupIntent();
        return view('admin.pasarelaPago.pago', compact("plan", "intent", "data", "totalPriceFormatted"));
    }

    public function subscription(Request $request)
    {
        $expirationDate = $request->input('expirationDate');
        list($month, $year) = explode('/', $expirationDate);
        $checkbox1 = $request->input('checkbox1');
        $plans = json_decode($request->input('plan'), true);
        $lineItems = [];
        $subscriptionIds = [];

        foreach ($plans as $plan) {
            try {
                $subscriptionBuilder = $request->user()->newSubscription($plan['name'], $plan['id'])
                    ->add([
                        [
                            'price_data' => [
                                'currency' => 'mxn',
                                'product' => $plan['product'],
                                'unit_amount' => $plan['price'] * 100,
                            ],
                            'quantity' => 1,
                        ],
                    ]);
                // if ($checkbox1 == 'on') {
                //     $subscription = $subscriptionBuilder->create([
                //         'payment_method' => $request->payment_method_id,
                //         'payment_method_options' => [
                //             'default_payment_method' => true,
                //         ],
                //     ]);
                // } else {
                //     $subscription = $subscriptionBuilder->create();
                // }
                // $subscriptionIds[] = $subscription->id;
            } catch (IncompletePayment $exception) {
                //return redirect()->route('checkout.payment', ['subscription_id' => $subscription->id]);
            } catch (\Exception $exception) {
                return back()->withError('Error al crear la suscripción: ' . $exception->getMessage());
            }
        }
        return view("admin.pasarelaPago.pago-confirmado");
    }

    public function pagoConfirmado()
    {
        return view('admin.pasarelaPago.pago-confirmado');
    }

    public function createPaymentIntent(Request $request)
    {
        dd("hola2");
        $nombrePago = $request->input('nombrePago');
        $apellidoPaternoPago = $request->input('apellidoPaternoPago');
        $apellidoMaternoPago = $request->input('apellidoMaternoPago');
        $cardNumber = $request->input('cardNumber');
        $cvv = $request->input('cvv');
        $expirationDate = $request->input('expirationDate');
        list($month, $year) = explode('/', $expirationDate);
        $expMonth = (int) $month;
        $expYear = (int) ('20' . $year);
        $checkbox1 = $request->input('checkbox1');
        try {
            Stripe::setApiKey(env('STRIPE_SECRET'));

            // Verificar si el método de pago existe
            $paymentMethodId = $request->input('payment_method_id');
            $paymentMethod = null;

            if ($paymentMethodId) {
                try {
                    $paymentMethod = PaymentMethod::retrieve($paymentMethodId);
                } catch (\Stripe\Exception\InvalidRequestException $e) {
                    // El método de pago no existe o no se pudo recuperar
                }
            }

            // Si no existe el método de pago, crearlo y luego realizar el pago y la suscripción
            if (!$paymentMethod) {
                // Crear el método de pago en Stripe
                $paymentMethod = PaymentMethod::create([
                    'type' => 'card',
                    'card' => [
                        'number' => $cardNumber,
                        'exp_month' => $expMonth,
                        'exp_year' => $expYear,
                        'cvc' => $cvv,
                    ],
                ]);

                // Ahora puedes usar $paymentMethod->id para obtener el ID del método de pago creado

                $plans = json_decode($request->input('plan'), true);

                $lineItems = [];

                foreach ($plans as $plan) {
                    $lineItems[] = [
                        'price_data' => [
                            'currency' => 'mxn',
                            'product' => $plan['id'],
                            'unit_amount' => $plan['price'] * 100,
                        ],
                        'quantity' => 1,
                    ];
                }

                // Crear el intento de pago con Stripe
                $paymentIntent = PaymentIntent::create([
                    'amount' => calculateTotalAmountw($lineItems),
                    'currency' => 'mxn',
                    'payment_method_types' => ['card'],
                    'customer' => $request->user()->stripe_id,
                    'line_items' => $lineItems,
                    'metadata' => [
                        'product_ids' => array_column($lineItems, 'product_data.product'),
                    ],
                    'payment_method' => $paymentMethod->id, // Asociar el método de pago recién creado
                ]);

                // Confirmar el intento de pago
                $paymentIntent->confirm([
                    'payment_method' => $request->input('cardNumber')
                ]);

                // Si se proporciona un plan, crear la suscripción
                if ($request->has('plan_id')) {
                    $planId = $request->input('plan_id');
                    $user = $request->user();

                    // Crear la suscripción utilizando la API de Stripe
                    $subscription = CashierSubscription::create([
                        'customer' => $request->user()->stripe_id,
                        'items' => [
                            [
                                'price' => $planId, // ID del precio del plan en Stripe
                            ],
                        ],
                        'payment_behavior' => 'default_incomplete',
                    ]);

                    // Opcional: Guardar el método de pago si está activo
                    if ($request->input('save_payment_method') && $paymentMethod->card->checks->cvc_check === 'pass') {
                        // Adjuntar el método de pago al cliente para futuras transacciones
                        \Stripe\Customer::update(
                            $request->user()->stripe_id,
                            ['invoice_settings' => ['default_payment_method' => $paymentMethod->id]]
                        );
                    }
                }

                return response()->json([
                    'clientSecret' => $paymentIntent->client_secret,
                ]);
            } else {
                // Si el método de pago ya existe, manejar el caso según tus necesidades
                // Aquí puedes retornar un mensaje de error o realizar alguna acción específica
                return response()->json(['error' => 'El método de pago ya existe.'], 422);
            }
        } catch (CardException $e) {
            // Manejar excepción si ocurre un problema con la tarjeta de crédito
            return response()->json(['error' => $e->getMessage()], 422);
        } catch (\Exception $e) {
            // Manejar otras excepciones generales
            return response()->json(['error' => $e->getMessage()], 500);
        }

        function calculateTotalAmountw($lineItems)
        {
            $total = 0;
            foreach ($lineItems as $item) {
                $total += $item['price_data']['unit_amount'] * $item['quantity'];
            }
            return $total;
        }
    }
}
