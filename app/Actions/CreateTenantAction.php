<?php

namespace App\Actions;

use App\Models\Tenant;
use App\Services\TenantManager;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
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
        ]);

        $tenant = Tenant::create($data + [
            'ready' => false,
            'trial_ends_at' => now()->addDays(config('saas.trial_days')),
        ]);

        $tenant->createDomain([
            'domain' => $domain,
        ])->makePrimary()->makeFallback();

        if ($createStripeCustomer) {
            $tenant->createAsStripeCustomer();
        }

        $this->createDatabase($tenant);
        tenancy()->initialize($tenant);


        return $tenant;
    }

    protected function createDatabase(Tenant $tenant)
    {
        $databaseName = 'tenant_' . $tenant->id;

        $databaseName = str_replace('-', '_', $databaseName);
        $tenant->update(['db_name' => $databaseName]);
        DB::statement("CREATE DATABASE $databaseName");

        app(TenantManager::class)->setTenant($tenant);

        $this->runMigrations();
    }

    protected function runMigrations()
    {
        if (!DB::connection('tenant')->getPdo()) {
            dd("No se pudo conectar a la base de datos del inquilino.");
        } else {
            $pdo = DB::connection('tenant')->getPdo();
            $databaseName = DB::connection('tenant')->getDatabaseName();
            Artisan::call('migrate', [
                '--database' => 'tenant',
                '--path' => 'database/migrations/tabantaj',
                '--force' => true,
            ]);
        }
    }
}
