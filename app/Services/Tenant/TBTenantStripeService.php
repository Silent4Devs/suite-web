<?php

namespace App\Services\Tenant;

use Exception;
use Illuminate\Support\Facades\Cache;
use Stripe\Customer;
use Stripe\Product;
use Stripe\Stripe;
use Stripe\StripeClient;

class TBTenantStripeService
{

    protected $tbStripeClient;

    public function __construct()
    {
        $this->tbInitializeStripeClient();
    }

    /**
     * Inicializa la instancia de StripeClient.
     *
     * @return void
     *
     * @throws \Exception
     */
    protected function tbInitializeStripeClient()
    {
        $tbStripeSecret = env('STRIPE_SECRET');

        if (! $tbStripeSecret) {
            throw new Exception('No se encontraron las credenciales de Stripe en el archivo .env.');
        }

        Stripe::setApiKey($tbStripeSecret);
        $this->tbStripeClient = new StripeClient($tbStripeSecret);
    }

    /**
     * Obtiene la instancia de StripeClient.
     */
    public function tbGetStripeClient(): StripeClient
    {
        return $this->tbStripeClient;
    }

    /**
     * Obtiene un cliente de Stripe por su ID.
     *
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function tbGetCustomerById(string $tbCustomerId): Customer
    {
        try {
            return $this->tbStripeClient->customers->retrieve($tbCustomerId);
        } catch (\Stripe\Exception\ApiErrorException $e) {
            throw new Exception('Error al obtener el cliente: ' . $e->getMessage());
        }
    }

    /**
     * Obtiene las suscripciones de un cliente de Stripe.
     *
     * @return \Stripe\Collection
     *
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function tbGetCustomerSubscriptions(string $tbCustomerId)
    {
        try {
            return $this->tbStripeClient->subscriptions->all(['customer' => $tbCustomerId]);
        } catch (\Stripe\Exception\ApiErrorException $e) {
            throw new Exception('Error al obtener las suscripciones del cliente: ' . $e->getMessage());
        }
    }

    /**
     * Obtiene el detalle de un producto de Stripe por su ID.
     *
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function tbGetProductDetailsById(string $tbProductId): Product
    {
        try {
            return $this->tbStripeClient->products->retrieve($tbProductId);
        } catch (\Stripe\Exception\ApiErrorException $e) {
            throw new Exception('Error al obtener el producto: ' . $e->getMessage());
        }
    }

    /**
     * Obtiene las suscripciones que no están activas para un cliente.
     *
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function tbGetInactiveSubscriptionsByCustomer(string $tbCustomerId): array
    {
        try {
            \Stripe\Customer::retrieve($tbCustomerId);

            $tbSubscriptions = $this->tbGetCustomerSubscriptions($tbCustomerId);
            $subscribedProductIds = [];

            foreach ($tbSubscriptions->data as $tbSubscription) {
                foreach ($tbSubscription->items->data as $tbItem) {
                    $subscribedProductIds[] = $tbItem->price->product;
                }
            }

            $tbProducts = \Stripe\Product::all(['active' => true]);

            $unsubscribedProducts = [];

            foreach ($tbProducts->data as $product) {
                if (! in_array($product->id, $subscribedProductIds)) {
                    $unsubscribedProducts[] = [
                        'id' => $product->id,
                        'name' => $product->name,
                        'description' => $product->description,
                        'active' => $product->active,
                        'images' => $product->images,
                        'img' => $product->metadata['img'] ?? null,
                    ];
                }
            }

            return $unsubscribedProducts;
        } catch (\Stripe\Exception\ApiErrorException $e) {
            throw new Exception('Error al obtener los productos no suscritos activos del cliente: ' . $e->getMessage());
        }
    }

    /**
     * Obtiene todos los productos de un cliente a través de sus suscripciones.
     *
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function tbGetProductsByCustomer(string $tbCustomerId): array
    {
        try {
            \Stripe\Customer::retrieve($tbCustomerId);

            $tbSubscriptions = $this->tbGetCustomerSubscriptions($tbCustomerId);
            $tbProducts = [];

            foreach ($tbSubscriptions->data as $tbSubscription) {
                foreach ($tbSubscription->items->data as $tbItem) {

                    $product = \Stripe\Product::retrieve($tbItem->price->product);
                    $price = $tbItem->price;

                    $paymentMethod = null;
                    $cardDetails = null;

                    if ($tbSubscription->default_payment_method) {
                        $paymentMethod = \Stripe\PaymentMethod::retrieve($tbSubscription->default_payment_method);
                        $cardDetails = $paymentMethod->card ?? null;
                    }

                    $tbProducts[] = [
                        'active' => $product->active,
                        'id' => $product->id,
                        'images' => $product->images,
                        'name' => $product->name,
                        'description' => $product->description,
                        'img' => $product->metadata['img'] ?? null,
                        'price' => [
                            'amount' => $price->unit_amount / 100,
                            'currency' => strtoupper($price->currency),
                            'interval' => $price->recurring->interval ?? null,
                        ],
                        'payment_method' => $paymentMethod->type ?? 'unknown',
                        'last4' => $cardDetails ? $cardDetails->last4 : null,
                        'subscription_start' => $tbSubscription->start_date ? date('Y-m-d', $tbSubscription->start_date) : null,
                        'subscription_end' => $tbSubscription->current_period_end ? date('Y-m-d', $tbSubscription->current_period_end) : null,
                    ];
                }
            }

            return $tbProducts;
        } catch (\Stripe\Exception\ApiErrorException $e) {
            throw new Exception('Error al obtener los productos del cliente: ' . $e->getMessage());
        }
    }

    /**
     * Obtiene todos los productos activos de Stripe.
     *
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function tbGetAllActiveProducts(): array
    {
        try {
            $allProducts = \Stripe\Product::all(['active' => true]);
            $products = [];

            foreach ($allProducts->data as $product) {
                $products[] = [
                    'active' => $product->active,
                    'id' => $product->id,
                    'images' => $product->images,
                    'name' => $product->name,
                    'description' => $product->description,
                    'img' => $product->metadata['img'] ?? null,
                ];
            }

            return $products;
        } catch (\Stripe\Exception\ApiErrorException $e) {
            throw new Exception('Error al obtener los productos activos: ' . $e->getMessage());
        }
    }

    /**
     * Obtiene los productos no adquiridos por un cliente a través de sus suscripciones.
     *
     * @param  string  $tbCustomerId
     *
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function tbGetUnpurchasedProducts(): array
    {
        try {
            $allProducts = \Stripe\Product::all(['active' => true]);
            $unpurchasedProducts = [];
            $totalMonthlyAmount = 0;
            $totalYearlyAmount = 0;

            foreach ($allProducts->data as $product) {
                $prices = \Stripe\Price::all(['product' => $product->id]);
                $formattedPrices = [];

                foreach ($prices->data as $price) {
                    $formattedPrice = [
                        'id' => $price->id,
                        'amount' => $price->unit_amount / 100,
                        'currency' => strtoupper($price->currency),
                        'interval' => $price->recurring->interval ?? null,
                    ];

                    if ($price->recurring) {
                        if ($price->recurring->interval === 'month') {
                            $totalMonthlyAmount += $formattedPrice['amount'];
                        } elseif ($price->recurring->interval === 'year') {
                            $totalYearlyAmount += $formattedPrice['amount'];
                        }
                    }

                    $formattedPrices[] = $formattedPrice;
                }

                $unpurchasedProducts[] = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'prices' => $formattedPrices,
                    'img' => $product->metadata['img'] ?? null,
                ];
            }

            return [
                'unpurchased_products' => $unpurchasedProducts,
                'total_monthly_amount' => $totalMonthlyAmount,
                'total_yearly_amount' => $totalYearlyAmount,
            ];
        } catch (\Stripe\Exception\ApiErrorException $e) {
            throw new Exception('Error al obtener los productos: ' . $e->getMessage());
        }
    }

    /**
     * Verifica el estado de suscripciones de un cliente para determinar si tiene acceso a los módulos válidos.
     *
     * Este método revisa las suscripciones activas de un cliente y valida si alguna de ellas coincide con los módulos
     * válidos proporcionados. Si una suscripción activa pertenece a un módulo válido, el método devuelve `true`,
     * de lo contrario, devuelve `false`. Si no hay suscripciones o las suscripciones no son válidas, también se devuelve `false`.
     *
     * @param  array  $tbSuscripciones  Listado de las suscripciones del cliente.
     * @param  array  $tbModulosValidos  Módulos que se consideran válidos para el acceso.
     * @return bool `true` si el cliente tiene acceso a uno de los módulos válidos, `false` en caso contrario.
     *
     * @throws \Throwable En caso de error inesperado, se aborta con un error 403.
     */
    public function tbTenantSubscriptionStatus($tbSuscripciones, $tbModulosValidos)
    {
        try {
            if (! empty($tbSuscripciones) && is_array($tbSuscripciones)) {
                foreach ($tbSuscripciones as $tbSuscripcion) {
                    if (in_array($tbSuscripcion['name'], $tbModulosValidos) && $tbSuscripcion['active'] === true) {
                        return true;
                    } else {
                        return false;
                    }
                }
            } else {
                return false;
            }
        } catch (\Throwable $tbTh) {
            abort(403);
        }
    }

    // public function tbTenantSubscriptionStatusOnPremise($tbModulosValidos)
    // {
    //     try {
    //         $clientKey = env('CLIENT_KEY');
    //         $clientKeyApi = env('CLIENT_KEYAPI');

    //         if (!$clientKey || !$clientKeyApi) {
    //             die(json_encode(['error' => 'CLIENT_KEY o CLIENT_KEYAPI no están definidos.']));
    //         }

    //         $payload = json_encode(['uuid' => "89c32beb-3981-4524-9080-138b074be02b"]);

    //         $curl = curl_init();

    //         curl_setopt_array($curl, [
    //             CURLOPT_URL => $clientKeyApi,
    //             CURLOPT_RETURNTRANSFER => true,
    //             CURLOPT_ENCODING => '',
    //             CURLOPT_MAXREDIRS => 10,
    //             CURLOPT_TIMEOUT => 30,
    //             CURLOPT_FOLLOWLOCATION => true,
    //             CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //             CURLOPT_POST => true,
    //             CURLOPT_POSTFIELDS => $payload,
    //             CURLOPT_HTTPHEADER => [
    //                 'Content-Type: application/json',
    //                 'Accept: application/json'
    //             ],
    //         ]);

    //         $response = curl_exec($curl);
    //         dd($response);
    //         if (curl_errno($curl)) {
    //             die(json_encode(['error' => 'cURL Error: ' . curl_error($curl)]));
    //         }

    //         curl_close($curl);

    //         $jsonData = json_decode($response, true);

    //         if (!empty($jsonData) && is_array($jsonData)) {
    //             foreach ($jsonData as $cliente) {
    //                 if ($cliente['Estatus'] === true) {
    //                     if (!empty($cliente['modulos']) && is_array($cliente['modulos'])) {
    //                         foreach ($cliente['modulos'] as $modulo) {
    //                             if (in_array($modulo['nombre_catalogo'], $tbModulosValidos) && $modulo['estatus'] === true) {
    //                                 return true;
    //                             }
    //                         }
    //                     }
    //                 }
    //             }
    //             return false;
    //         }
    //         return false;
    //     } catch (\Throwable $tbTh) {
    //         abort(403, 'Error en la verificación de suscripción');
    //     }
    // }

    public function tbTenantSubscriptionStatusOnPremise($tbModulosValidos)
    {
        try {
            $clientKey = env('CLIENT_KEY');
            $clientKeyApi = env('CLIENT_KEYAPI');

            if (!$clientKey || !$clientKeyApi) {
                die(json_encode(['error' => 'CLIENT_KEY o CLIENT_KEYAPI no están definidos.']));
            }

            $cacheKey = 'subscription_status';
            $jsonData = Cache::get($cacheKey);

            if (!$jsonData) {
                $payload = json_encode(['uuid' => "89c32beb-3981-4524-9080-138b074be02b"]);

                $curl = curl_init();

                curl_setopt_array($curl, [
                    CURLOPT_URL => $clientKeyApi,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_POST => true,
                    CURLOPT_POSTFIELDS => $payload,
                    CURLOPT_HTTPHEADER => [
                        'Content-Type: application/json',
                        'Accept: application/json'
                    ],
                ]);

                $response = curl_exec($curl);

                if (curl_errno($curl)) {
                    die(json_encode(['error' => 'cURL Error: ' . curl_error($curl)]));
                }

                curl_close($curl);

                $jsonData = json_decode($response, true);

                if ($jsonData) {
                    Cache::put($cacheKey, $jsonData, now()->addDay());
                }
            }

            if (!empty($jsonData) && is_array($jsonData)) {
                foreach ($jsonData as $cliente) {
                    if ($cliente['Estatus'] === true) {
                        if (!empty($cliente['modulos']) && is_array($cliente['modulos'])) {
                            foreach ($cliente['modulos'] as $modulo) {
                                if (in_array($modulo['nombre_catalogo'], $tbModulosValidos) && $modulo['estatus'] === true) {
                                    return true;
                                }
                            }
                        }
                    }
                }
                return false;
            }
            return false;
        } catch (\Throwable $tbTh) {
            abort(403, 'Error en la verificación de suscripción');
        }
    }



    /**
     * Obtiene el historial de compras de un cliente.
     *
     * @return \Stripe\Collection
     *
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function tbGetPurchaseHistory(string $tbCustomerId)
    {
        try {
            $paymentIntents = $this->tbStripeClient->paymentIntents->all(['customer' => $tbCustomerId]);

            $purchaseHistory = [];
            foreach ($paymentIntents->data as $paymentIntent) {
                $charge = $paymentIntent->charges->data[0] ?? null;

                $paymentDetails = $charge->payment_method_details ?? null;
                $last4 = $paymentDetails->card->last4 ?? 'N/A';
                $productName = $paymentIntent->metadata['product_name'] ?? 'Producto desconocido';

                $purchaseHistory[] = [
                    'amount' => $paymentIntent->amount / 100,
                    'currency' => strtoupper($paymentIntent->currency),
                    'date' => date('Y-m-d H:i:s', $paymentIntent->created),
                    'product_name' => $productName,
                    'payment_method' => '**** **** **** ' . $last4,
                ];
            }

            return $purchaseHistory;
        } catch (\Stripe\Exception\ApiErrorException $e) {
            throw new Exception('Error al obtener el historial de compras: ' . $e->getMessage());
        }
    }

    /**
     * Obtiene las tarjetas guardadas de un cliente.
     *
     * @return \Stripe\Collection
     *
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function tbGetSavedCards(string $tbCustomerId)
    {
        try {
            $cards = $this->tbStripeClient->paymentMethods->all([
                'customer' => $tbCustomerId,
                'type' => 'card',
            ]);

            $savedCards = [];
            foreach ($cards->data as $card) {
                $savedCards[] = [
                    'type' => ucfirst($card->card->brand),
                    'last4' => $card->card->last4,
                    'added_date' => date('Y-m-d H:i:s', $card->created),
                    'is_active' => $card->card->checks->cvc_check === 'pass',
                ];
            }

            return $savedCards;
        } catch (\Stripe\Exception\ApiErrorException $e) {
            throw new Exception('Error al obtener las tarjetas guardadas: ' . $e->getMessage());
        }
    }

    /**
     * Agrega un nuevo método de pago para un cliente. se necesita agregar primero una tarjeta para asiciarlo
     *
     * @return \Stripe\PaymentMethod
     *
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function tbAddPaymentMethod(string $tbCustomerId, string $tbPaymentMethodId)
    {
        try {
            $this->tbStripeClient->paymentMethods->attach($tbPaymentMethodId, [
                'customer' => $tbCustomerId,
            ]);

            return $this->tbStripeClient->paymentMethods->retrieve($tbPaymentMethodId);
        } catch (\Stripe\Exception\ApiErrorException $e) {
            throw new Exception('Error al agregar el método de pago: ' . $e->getMessage());
        }
    }

    /**
     * Agrega una tarjeta como método de pago para un cliente. agrega y aoscia metodo de pago
     *
     * @param  string  $tbCustomerId  El ID del cliente en Stripe.
     * @param  string  $cardNumber  El número de la tarjeta de crédito.
     * @param  int  $expMonth  El mes de expiración de la tarjeta (1-12).
     * @param  int  $expYear  El año de expiración de la tarjeta (4 dígitos).
     * @param  string  $cvc  El código de seguridad de la tarjeta.
     * @return \Stripe\PaymentMethod
     *
     * @throws Exception Si ocurre un error al agregar la tarjeta.
     */
    public function tbAddCard(string $tbCustomerId, string $cardNumber, int $expMonth, int $expYear, string $cvc)
    {
        try {
            // Crear el PaymentMethod para la tarjeta
            $paymentMethod = $this->tbStripeClient->paymentMethods->create([
                'type' => 'card',
                'card' => [
                    'number' => $cardNumber,
                    'exp_month' => $expMonth,
                    'exp_year' => $expYear,
                    'cvc' => $cvc,
                ],
            ]);

            // Asociar el PaymentMethod al cliente
            $this->tbStripeClient->paymentMethods->attach($paymentMethod->id, [
                'customer' => $tbCustomerId,
            ]);

            return $this->tbStripeClient->paymentMethods->retrieve($paymentMethod->id);
        } catch (\Stripe\Exception\ApiErrorException $e) {
            throw new Exception('Error al agregar la tarjeta: ' . $e->getMessage());
        }
    }

    /**
     * Elimina un método de pago de un cliente.
     *
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function tbRemovePaymentMethod(string $tbPaymentMethodId)
    {
        try {
            $this->tbStripeClient->paymentMethods->detach($tbPaymentMethodId);
        } catch (\Stripe\Exception\ApiErrorException $e) {
            throw new Exception('Error al eliminar el método de pago: ' . $e->getMessage());
        }
    }

    /**
     * Obtiene la dirección de facturación de un cliente.
     *
     * @return array
     *
     * @throws \Stripe\Exception\ApiErrorException
     */
    // : array Se comento ya que la Api retorna un objeto
    public function tbGetBillingAddress(string $tbCustomerId)
    {
        try {
            $tbCustomer = $this->tbGetCustomerById($tbCustomerId);

            return $tbCustomer->address ?: [];
        } catch (\Stripe\Exception\ApiErrorException $e) {
            throw new Exception('Error al obtener la dirección de facturación: ' . $e->getMessage());
        }
    }

    /**
     * Agrega una nueva dirección de facturación para un cliente.
     *
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function tbAddBillingAddress(string $tbCustomerId, array $tbBillingAddress): Customer
    {
        return $this->tbUpdateBillingAddress($tbCustomerId, $tbBillingAddress);
    }

    /**
     * Elimina la dirección de facturación de un cliente.
     *
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function tbRemoveBillingAddress(string $tbCustomerId): Customer
    {
        try {
            return $this->tbStripeClient->customers->update($tbCustomerId, ['address' => null]);
        } catch (\Stripe\Exception\ApiErrorException $e) {
            throw new Exception('Error al eliminar la dirección de facturación: ' . $e->getMessage());
        }
    }

    /**
     * Actualiza la dirección de facturación de un cliente.
     *
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function tbUpdateBillingAddress(string $tbCustomerId, array $tbBillingAddress): Customer
    {
        try {
            return $this->tbStripeClient->customers->update($tbCustomerId, ['address' => $tbBillingAddress]);
        } catch (\Stripe\Exception\ApiErrorException $e) {
            throw new Exception('Error al actualizar la dirección de facturación: ' . $e->getMessage());
        }
    }

    /**
     * Crea una suscripción para varios productos de un cliente en Stripe.
     *
     * Este método permite crear una suscripción con múltiples productos seleccionados
     * por un cliente en Stripe. Los productos se agregan usando los IDs de precio de
     * cada producto, y la suscripción será configurada según el intervalo de pago
     * definido en los precios de los productos.
     *
     * @param  string  $tbCustomerId  El ID del cliente en Stripe.
     * @param  array  $productPriceIds  Un arreglo de IDs de precios de los productos a suscribir.
     * @return array Un arreglo con el ID de la sesión de Stripe y la URL para el pago en Stripe.
     *
     * @throws \Stripe\Exception\ApiErrorException Si ocurre un error en la API de Stripe.
     */
    public function createSubscriptionForMultipleProducts(string $tbCustomerId, array $productPriceIds): array
    {
        try {
            $customer = \Stripe\Customer::retrieve($tbCustomerId);

            if (! $customer) {
                throw new Exception('Cliente no encontrado en Stripe.');
            }

            $lineItems = [];
            $productDetails = [];
            foreach ($productPriceIds as $priceId) {

                $price = \Stripe\Price::retrieve($priceId);
                $product = \Stripe\Product::retrieve($price->product);

                $lineItems[] = [
                    'price' => $priceId,
                    'quantity' => 1,
                ];

                $productDetails[] = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => $price->unit_amount / 100,
                    'currency' => strtoupper($price->currency),
                    'interval' => $price->recurring->interval ?? null,
                ];
            }

            if (empty($lineItems)) {
                throw new Exception('No se proporcionaron productos para contratar.');
            }

            $session = \Stripe\Checkout\Session::create([
                'customer' => $tbCustomerId,
                'payment_method_types' => ['card'],
                'line_items' => $lineItems,
                'mode' => 'subscription',
                'success_url' => env('APP_URL') . '/success?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => env('APP_URL') . '/cancel',
                'payment_intent_data' => [
                    'setup_future_usage' => 'off_session',
                ],
            ]);

            return [
                'session_id' => $session->id,
                'url' => $session->url,
                'product_details' => $productDetails,
            ];
        } catch (\Stripe\Exception\ApiErrorException $e) {
            throw new Exception('No se pudo procesar la contratación: ' . $e->getMessage());
        }
    }
}
