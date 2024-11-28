<?php

namespace App\Services;

use Exception;
use Stripe\StripeClient;
use Illuminate\Support\Facades\DB;
use Stripe\Customer;
use Stripe\Product;
use Stripe\Stripe;

class TbStripeService
{
    protected $stripeClient;

    public function __construct()
    {
        $this->initializeStripeClient();
    }

    /**
     * Inicializa la instancia de StripeClient.
     *
     * @return void
     * @throws \Exception
     */
    protected function initializeStripeClient()
    {
        $stripeSecret = env('STRIPE_SECRET');

        if (!$stripeSecret) {
            throw new Exception('No se encontraron las credenciales de Stripe en el archivo .env.');
        }

        Stripe::setApiKey($stripeSecret);
        $this->stripeClient = new StripeClient($stripeSecret);
    }

    /**
     * Obtiene la instancia de StripeClient.
     *
     * @return StripeClient
     */
    public function getStripeClient(): StripeClient
    {
        return $this->stripeClient;
    }

    /**
     * Obtiene un cliente de Stripe por su ID.
     *
     * @param string $customerId
     * @return \Stripe\Customer
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function getCustomerById(string $customerId): Customer
    {
        try {
            return $this->stripeClient->customers->retrieve($customerId);
        } catch (\Stripe\Exception\ApiErrorException $e) {
            throw new Exception("Error al obtener el cliente: " . $e->getMessage());
        }
    }

    /**
     * Obtiene las suscripciones de un cliente de Stripe.
     *
     * @param string $customerId
     * @return \Stripe\Collection
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function getCustomerSubscriptions(string $customerId)
    {
        try {
            return $this->stripeClient->subscriptions->all(['customer' => $customerId]);
        } catch (\Stripe\Exception\ApiErrorException $e) {
            throw new Exception("Error al obtener las suscripciones del cliente: " . $e->getMessage());
        }
    }

    /**
     * Obtiene el detalle de un producto de Stripe por su ID.
     *
     * @param string $productId
     * @return \Stripe\Product
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function getProductDetailsById(string $productId): Product
    {
        try {
            return $this->stripeClient->products->retrieve($productId);
        } catch (\Stripe\Exception\ApiErrorException $e) {
            throw new Exception("Error al obtener el producto: " . $e->getMessage());
        }
    }

    /**
     * Obtiene todos los productos de un cliente a través de sus suscripciones.
     *
     * @param string $customerId
     * @return array
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function getProductsByCustomer(string $customerId): array
    {
        try {
            $subscriptions = $this->getCustomerSubscriptions($customerId);
            $products = [];

            foreach ($subscriptions->data as $subscription) {
                foreach ($subscription->items->data as $item) {
                    $products[] = $this->getProductDetailsById($item->price->product);
                }
            }

            return $products;
        } catch (\Stripe\Exception\ApiErrorException $e) {
            throw new Exception("Error al obtener los productos del cliente: " . $e->getMessage());
        }
    }
}
