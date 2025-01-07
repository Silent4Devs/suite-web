<?php

namespace App\Actions\Tenant;

use App\Models\Tenant;
use App\Models\Tenant\TbTenantUserModel;
use App\Services\Tenant\TBTenantTenantManager;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

/**
 * Create a tenant with the necessary information for the application.
 *
 * We don't use a listener here, because we want to be able to create "simplified" tenants in tests.
 * This action is only used when we need to create the tenant properly (with billing logic etc).
 */
class TBTenantCreateTenantAction
{
    /**
     * Crea un nuevo inquilino con el dominio especificado, datos de usuario y cliente en Stripe si es necesario.
     *
     * @param  array  $tbData  Datos del inquilino.
     * @param  string  $tbDomain  Dominio del inquilino.
     * @param  bool  $tbCreateStripeCustomer  Indica si se debe crear un cliente en Stripe.
     */
    public function __invoke(array $tbData, string $tbDomain, bool $tbCreateStripeCustomer = true): Tenant
    {
        $tbData = $this->tbPrepareTenantData($tbData, $tbDomain);

        $tbTenant = $this->tbCreateTenant($tbData, $tbDomain);

        if ($tbCreateStripeCustomer) {
            $tbTenant->createAsStripeCustomer();
        }

        $this->tbInitializeTenantDatabase($tbTenant, $tbData['tb_user_data']);
        tenancy()->initialize($tbTenant);

        return $tbTenant;
    }

    /**
     * Prepara los datos del inquilino.
     */
    protected function tbPrepareTenantData(array $tbData, string $tbDomain): array
    {
        return array_merge($tbData, [
            'db_name' => $tbDomain ?? 'default_db_name',
            'db_host' => 'localhost',
            'db_username' => 'postgres',
            'db_password' => '',
            'tb_user_data' => [
                'name' => $tbData['name'] ?? null,
                'email' => $tbData['email'] ?? null,
                'password' => $tbData['password'] ?? null,
                'direccion' => $tbData['direccion'] ?? null,
                'resumen' => $tbData['resumen'] ?? null,
            ],
        ]);
    }

    /**
     * Crea el inquilino y el dominio asociado.
     */
    protected function tbCreateTenant(array $tbData, string $tbDomain): Tenant
    {
        $tbTenant = Tenant::create($tbData + [
            'ready' => false,
            'trial_ends_at' => now()->addDays(config('saas.trial_days')),
        ]);

        $tbTenant->createDomain(['domain' => $tbDomain])
            ->makePrimary()
            ->makeFallback();

        $tbUserId = $tbData['userId'] ?? null;

        if (! $tbUserId) {
            throw new \InvalidArgumentException("El ID del usuario no esta definido en los datos proporcionados.{$tbUserId}");
        }

        try {
            $tbTenantUser = TbTenantUserModel::findOrFail($tbUserId);
            $tbTenantUser->tenant_Id = $tbTenant->id;
            $tbTenantUser->save();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            throw new \Exception("No se encontró el usuario con ID: {$tbUserId}");
        }

        return $tbTenant;
    }

    /**
     * Configura y ejecuta la creación de la base de datos del inquilino.
     */
    protected function tbInitializeTenantDatabase(Tenant $tbTenant, array $tbUserData)
    {
        $this->tbCreateDatabaseForTenant($tbTenant);
        app(TBTenantTenantManager::class)->tbSetTenant($tbTenant);

        $this->tbRunMigrations();
        $this->tbSeedInitialData($tbUserData);
    }

    /**
     * Crea la base de datos del inquilino.
     */
    protected function tbCreateDatabaseForTenant(Tenant $tbTenant)
    {
        $tbDatabaseName = 'tenant_'.str_replace('-', '_', $tbTenant->id);
        $tbTenant->update(['db_name' => $tbDatabaseName]);

        DB::statement("CREATE DATABASE $tbDatabaseName");
    }

    /**
     * Ejecuta las migraciones para la base de datos del inquilino.
     */
    protected function tbRunMigrations()
    {
        if (DB::connection('tenant')->getPdo()) {
            Artisan::call('migrate', [
                '--database' => 'tenant',
                '--path' => 'database/migrations/tabantaj',
                '--force' => true,
            ]);
        } else {
            throw new Exception('No se pudo conectar a la base de datos del inquilino.');
        }
    }

    /**
     * Inserta datos iniciales en la base de datos del inquilino.
     */
    protected function tbSeedInitialData(array $tbUserData)
    {
        DB::connection('tenant')->beginTransaction();

        try {

            DB::connection('tenant')->table('empleados')->insert([
                'name' => $tbUserData['name'],
                'email' => $tbUserData['email'],
                'antiguedad' => Carbon::now(),
                'estatus' => 'alta',
                'direccion' => $tbUserData['direccion'],
                'resumen' => $tbUserData['resumen'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::connection('tenant')->table('users')->insert([
                'name' => $tbUserData['name'],
                'email' => $tbUserData['email'],
                'empleado_id' => 1,
                'password' => Hash::make($tbUserData['password']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Artisan::call('db:seed', [
                '--database' => 'tenant',
                '--force' => true,
            ]);

            DB::connection('tenant')->commit();
        } catch (Exception $tbException) {
            DB::connection('tenant')->rollBack();
            Log::error('Error al insertar datos iniciales: '.$tbException->getMessage());
            throw $tbException;
        }
    }
}
