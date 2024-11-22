<?php

namespace App\Actions;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Services\TenantManager;
use App\Models\Tenant;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Str;

/**
 * Create a tenant with the necessary information for the application.
 *
 * We don't use a listener here, because we want to be able to create "simplified" tenants in tests.
 * This action is only used when we need to create the tenant properly (with billing logic etc).
 */
class CreateTenantAction
{
    /**
     * Crea un nuevo inquilino con el dominio especificado, datos de usuario y cliente en Stripe si es necesario.
     *
     * @param array $data Datos del inquilino.
     * @param string $domain Dominio del inquilino.
     * @param bool $createStripeCustomer Indica si se debe crear un cliente en Stripe.
     * @return Tenant
     */
    public function __invoke(array $data, string $domain, bool $createStripeCustomer = true): Tenant
    {
        $data = $this->prepareTenantData($data, $domain);

        $tenant = $this->createTenant($data, $domain);

        if ($createStripeCustomer) {
            $tenant->createAsStripeCustomer();
        }

        $this->initializeTenantDatabase($tenant, $data['user_data']);
        tenancy()->initialize($tenant);

        return $tenant;
    }

    /**
     * Prepara los datos del inquilino.
     */
    protected function prepareTenantData(array $data, string $domain): array
    {
        return array_merge($data, [
            'db_name' => $domain ?? 'default_db_name',
            'db_host' => 'localhost',
            'db_username' => 'postgres',
            'db_password' => '',
            'user_data' => [
                'name' => $data['name'] ?? null,
                'email' => $data['email'] ?? null,
                'password' => $data['password'] ?? null,
                'direccion' => $data['direccion'] ?? null,
                'resumen' => $data['resumen'] ?? null,
            ],
        ]);
    }

    /**
     * Crea el inquilino y el dominio asociado.
     */
    protected function createTenant(array $data, string $domain): Tenant
    {
        $tenant = Tenant::create($data + [
            'ready' => false,
            'trial_ends_at' => now()->addDays(config('saas.trial_days')),
        ]);

        $tenant->createDomain(['domain' => $domain])
            ->makePrimary()
            ->makeFallback();

        return $tenant;
    }

    /**
     * Configura y ejecuta la creación de la base de datos del inquilino.
     */
    protected function initializeTenantDatabase(Tenant $tenant, array $userData)
    {
        $this->createDatabaseForTenant($tenant);
        app(TenantManager::class)->setTenant($tenant);

        $this->runMigrations();
        $this->seedInitialData($userData);
    }

    /**
     * Crea la base de datos del inquilino.
     */
    protected function createDatabaseForTenant(Tenant $tenant)
    {
        $databaseName = 'tenant_' . str_replace('-', '_', $tenant->id);
        $tenant->update(['db_name' => $databaseName]);

        DB::statement("CREATE DATABASE $databaseName");
    }

    /**
     * Ejecuta las migraciones para la base de datos del inquilino.
     */
    protected function runMigrations()
    {
        if (DB::connection('tenant')->getPdo()) {
            Artisan::call('migrate', [
                '--database' => 'tenant',
                '--path' => 'database/migrations/tabantaj2',
                '--force' => true,
            ]);
        } else {
            throw new Exception("No se pudo conectar a la base de datos del inquilino.");
        }
    }

    /**
     * Inserta datos iniciales en la base de datos del inquilino.
     */
    protected function seedInitialData(array $userData)
    {
        DB::connection('tenant')->beginTransaction();

        try {
            DB::connection('tenant')->table('users')->insert([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => Hash::make($userData['password']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::connection('tenant')->table('empleados')->insert([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'direccion' => $userData['direccion'],
                'resumen' => $userData['resumen'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Artisan::call('db:seed', [
                '--database' => 'tenant',
                '--force' => true,
            ]);

            DB::connection('tenant')->commit();
        } catch (Exception $e) {
            DB::connection('tenant')->rollBack();
            Log::error("Error al insertar datos iniciales: " . $e->getMessage());
            throw $e;
        }
    }
}
