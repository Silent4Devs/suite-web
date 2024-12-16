<?php

namespace App\Services\Tenant;

use Exception;
use Stripe\StripeClient;
use Illuminate\Support\Facades\DB;
use Stripe\Customer;
use Stripe\Product;
use Stripe\Stripe;

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
     * @throws \Exception
     */
    protected function tbInitializeStripeClient()
    {
        $tbStripeSecret = env('STRIPE_SECRET');

        if (!$tbStripeSecret) {
            throw new Exception('No se encontraron las credenciales de Stripe en el archivo .env.');
        }

        Stripe::setApiKey($tbStripeSecret);
        $this->tbStripeClient = new StripeClient($tbStripeSecret);
    }

    /**
     * Obtiene la instancia de StripeClient.
     *
     * @return StripeClient
     */
    public function tbGetStripeClient(): StripeClient
    {
        return $this->tbStripeClient;
    }

    /**
     * Obtiene un cliente de Stripe por su ID.
     *
     * @param string $tbCustomerId
     * @return \Stripe\Customer
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function tbGetCustomerById(string $tbCustomerId): Customer
    {
        try {
            return $this->tbStripeClient->customers->retrieve($tbCustomerId);
        } catch (\Stripe\Exception\ApiErrorException $e) {
            throw new Exception("Error al obtener el cliente: " . $e->getMessage());
        }
    }

    /**
     * Obtiene las suscripciones de un cliente de Stripe.
     *
     * @param string $tbCustomerId
     * @return \Stripe\Collection
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function tbGetCustomerSubscriptions(string $tbCustomerId)
    {
        try {
            return $this->tbStripeClient->subscriptions->all(['customer' => $tbCustomerId]);
        } catch (\Stripe\Exception\ApiErrorException $e) {
            throw new Exception("Error al obtener las suscripciones del cliente: " . $e->getMessage());
        }
    }

    /**
     * Obtiene el detalle de un producto de Stripe por su ID.
     *
     * @param string $tbProductId
     * @return \Stripe\Product
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function tbGetProductDetailsById(string $tbProductId): Product
    {
        try {
            return $this->tbStripeClient->products->retrieve($tbProductId);
        } catch (\Stripe\Exception\ApiErrorException $e) {
            throw new Exception("Error al obtener el producto: " . $e->getMessage());
        }
    }

    /**
     * Obtiene todos los productos de un cliente a través de sus suscripciones.
     *
     * @param string $tbCustomerId
     * @return array
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function tbGetProductsByCustomer(string $tbCustomerId): array
    {
        try {
            $tbSubscriptions = $this->tbGetCustomerSubscriptions($tbCustomerId);
            $tbProducts = [];

            foreach ($tbSubscriptions->data as $tbSubscription) {
                foreach ($tbSubscription->items->data as $tbItem) {
                    $tbProducts[] = $this->tbGetProductDetailsById($tbItem->price->product);
                }
            }

            return $tbProducts;
        } catch (\Stripe\Exception\ApiErrorException $e) {
            throw new Exception("Error al obtener los productos del cliente: " . $e->getMessage());
        }
    }

    /**
     * Verifica el estado de suscripciones de un cliente para determinar si tiene acceso a los módulos válidos.
     *
     * Este método revisa las suscripciones activas de un cliente y valida si alguna de ellas coincide con los módulos
     * válidos proporcionados. Si una suscripción activa pertenece a un módulo válido, el método devuelve `true`, 
     * de lo contrario, devuelve `false`. Si no hay suscripciones o las suscripciones no son válidas, también se devuelve `false`.
     *
     * @param array $tbSuscripciones Listado de las suscripciones del cliente.
     * @param array $tbModulosValidos Módulos que se consideran válidos para el acceso.
     * @return bool `true` si el cliente tiene acceso a uno de los módulos válidos, `false` en caso contrario.
     * @throws \Throwable En caso de error inesperado, se aborta con un error 403.
     */
    public function tbTenantSubscriptionStatus($tbSuscripciones, $tbModulosValidos)
    {
        try {
            if (!empty($tbSuscripciones) && is_array($tbSuscripciones)) {
                foreach ($tbSuscripciones as $tbSuscripcion) {
                    if (in_array($tbSuscripcion->tbName, $tbModulosValidos) && $tbSuscripcion->tbActive === true) {
                        return $tbSuscripcion->tbActive ? true : false;
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

    /**
     * Obtiene el historial de compras de un cliente.
     *
     * @param string $tbCustomerId
     * @return \Stripe\Collection
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function tbGetPurchaseHistory(string $tbCustomerId)
    {
        try {
            return $this->tbStripeClient->paymentIntents->all(['customer' => $tbCustomerId]);
        } catch (\Stripe\Exception\ApiErrorException $e) {
            throw new Exception("Error al obtener el historial de compras: " . $e->getMessage());
        }
    }

    /**
     * Obtiene las tarjetas guardadas de un cliente.
     *
     * @param string $tbCustomerId
     * @return \Stripe\Collection
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function tbGetSavedCards(string $tbCustomerId)
    {
        try {
            return $this->tbStripeClient->paymentMethods->all([
                'customer' => $tbCustomerId,
                'type' => 'card',
            ]);
        } catch (\Stripe\Exception\ApiErrorException $e) {
            throw new Exception("Error al obtener las tarjetas guardadas: " . $e->getMessage());
        }
    }

    /**
     * Agrega un nuevo método de pago para un cliente.
     *
     * @param string $tbCustomerId
     * @param string $tbPaymentMethodId
     * @return \Stripe\PaymentMethod
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
            throw new Exception("Error al agregar el método de pago: " . $e->getMessage());
        }
    }

    /**
     * Elimina un método de pago de un cliente.
     *
     * @param string $tbPaymentMethodId
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function tbRemovePaymentMethod(string $tbPaymentMethodId)
    {
        try {
            $this->tbStripeClient->paymentMethods->detach($tbPaymentMethodId);
        } catch (\Stripe\Exception\ApiErrorException $e) {
            throw new Exception("Error al eliminar el método de pago: " . $e->getMessage());
        }
    }

    /**
     * Obtiene la dirección de facturación de un cliente.
     *
     * @param string $tbCustomerId
     * @return array
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function tbGetBillingAddress(string $tbCustomerId): array
    {
        try {
            $tbCustomer = $this->tbGetCustomerById($tbCustomerId);
            return $tbCustomer->address ?: [];
        } catch (\Stripe\Exception\ApiErrorException $e) {
            throw new Exception("Error al obtener la dirección de facturación: " . $e->getMessage());
        }
    }

    /**
     * Agrega una nueva dirección de facturación para un cliente.
     *
     * @param string $tbCustomerId
     * @param array $tbBillingAddress
     * @return \Stripe\Customer
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function tbAddBillingAddress(string $tbCustomerId, array $tbBillingAddress): Customer
    {
        return $this->tbUpdateBillingAddress($tbCustomerId, $tbBillingAddress);
    }

    /**
     * Elimina la dirección de facturación de un cliente.
     *
     * @param string $tbCustomerId
     * @return \Stripe\Customer
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function tbRemoveBillingAddress(string $tbCustomerId): Customer
    {
        try {
            return $this->tbStripeClient->customers->update($tbCustomerId, ['address' => null]);
        } catch (\Stripe\Exception\ApiErrorException $e) {
            throw new Exception("Error al eliminar la dirección de facturación: " . $e->getMessage());
        }
    }

    /**
     * Actualiza la dirección de facturación de un cliente.
     *
     * @param string $tbCustomerId
     * @param array $tbBillingAddress
     * @return \Stripe\Customer
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function tbUpdateBillingAddress(string $tbCustomerId, array $tbBillingAddress): Customer
    {
        try {
            return $this->tbStripeClient->customers->update($tbCustomerId, ['address' => $tbBillingAddress]);
        } catch (\Stripe\Exception\ApiErrorException $e) {
            throw new Exception("Error al actualizar la dirección de facturación: " . $e->getMessage());
        }
    }
}