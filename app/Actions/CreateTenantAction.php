<?php

namespace App\Actions;

use App\Models\Tenant;
use App\Services\TenantManager;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

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
        $this->runMigrations();

        return $tenant;
    }

    protected function createDatabase(Tenant $tenant)
    {
        $databaseName = 'tenant_' . $tenant->id;

        DB::statement("CREATE DATABASE `$databaseName`");

        app(TenantManager::class)->setTenant($tenant);

        // DB::purge('tenant');
    }

    protected function runMigrations()
    {
        \Illuminate\Support\Facades\Artisan::call('tenants:artisan', [
            'artisanCommand' => 'migrate --database=tenant',
            '--tenants' => tenant('id'),
        ]);

        // Artisan::call('migrate', [
        //     '--database' => 'tenant_',
        //     '--path' => 'database/migration/tenat',
        //     '--force' => true,
        // ]);
    }
}
