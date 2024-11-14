<?php

namespace App\Actions;

use App\Models\Tenant;
use App\Services\TenantManager;
use Exception;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Log;
use Stancl\JobPipeline\JobPipeline;
use Stancl\Tenancy\Jobs\{CreateDatabase, MigrateDatabase, SeedDatabase};

/**
 * Create a tenant with the necessary information for the application.
 *
 * We don't use a listener here, because we want to be able to create "simplified" tenants in tests.
 * This action is only used when we need to create the tenant properly (with billing logic etc).
 */
class CreateTenantAction
{
    public function __invoke(array $data, string $domain, bool $createStripeCustomer = true): Tenant
    {
        $data = array_merge($data, [
            'db_name' => $domain ?? 'default_db_name',
            'db_host' => 'localhost',
            'db_username' => 'postgres',
            'db_password' => '',
            'user_data' => [
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password'],
                'direccion' => $data['direccion'],
                'resumen' => $data['resumen'],
            ],
        ]);

        // Crear el inquilino
        $tenant = Tenant::create($data + [
            'ready' => false,
            'trial_ends_at' => now()->addDays(config('saas.trial_days')),
        ]);

        // Crear dominio asociado
        $tenant->createDomain([
            'domain' => $domain,
        ])->makePrimary()->makeFallback();

        // Crear cliente en Stripe si es necesario
        if ($createStripeCustomer) {
            $tenant->createAsStripeCustomer();
        }

        // Crear base de datos y agregar datos iniciales
        $this->createDatabase($tenant, $data['user_data']); // Enviamos los datos del usuario

        tenancy()->initialize($tenant);

        return $tenant;
    }


    protected function createDatabase(Tenant $tenant, array $userData)
    {
        $databaseName = 'tenant_' . $tenant->id;

        $databaseName = str_replace('-', '_', $databaseName);
        $tenant->update(['db_name' => $databaseName]);
        DB::statement("CREATE DATABASE $databaseName");

        app(TenantManager::class)->setTenant($tenant);

        $this->runMigrations();

        $this->seedInitialData($userData);
    }

    protected function seedInitialData(array $userData)
    {
        try {
            // Verifica si la conexión está activa
            if (!DB::connection('tenant')->getPdo()) {
                throw new Exception("No se pudo conectar a la base de datos del inquilino.");
            }

            // Inserta los datos en la tabla `users`
            DB::connection('tenant')->table('users')->insert([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => bcrypt($userData['password']), // Asegúrate de hashear la contraseña
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Inserta los datos en la tabla `users`
            DB::connection('tenant')->table('empleados')->insert([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'direccion'  => $userData['direccion'],
                'resumen'  => $userData['resumen'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } catch (Exception $e) {
            Log::error("Error al insertar datos iniciales en la base de datos del inquilino: " . $e->getMessage());
            throw $e;
        }
    }


    protected function runMigrations()
    {
        if (!DB::connection('tenant')->getPdo()) {
            dd("No se pudo conectar a la base de datos del inquilino.");
        } else {
            DB::connection('tenant')->getPdo();
            DB::connection('tenant')->getDatabaseName();

            Artisan::call('migrate', [
                '--database' => 'tenant',
                '--path' => 'database/migrations/tabantaj2',
                '--force' => true,
            ]);

            Artisan::call('db:seed', [
                '--database' => 'tenant',
                '--force' => true,
            ]);
        }
    }
}
