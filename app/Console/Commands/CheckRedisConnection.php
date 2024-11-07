<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;
use App\Models\Tenant; // Ajusta esto al nombre del modelo de inquilino

class CheckRedisConnection extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'redis:check-connection';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check Redis connection for each tenant';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $tenantId = $this->argument('tenantId');

        if ($tenantId) {

            $tenant = Tenant::find($tenantId);
            if (!$tenant) {
                $this->error("Tenant with ID {$tenantId} not found.");
                return Command::FAILURE;
            }
            tenancy()->initialize($tenant);
        } else {
            
            $tenant = tenancy()->tenant;
            if (!$tenant) {
                $this->error("No tenant is currently initialized, and no tenant ID was provided.");
                return Command::FAILURE;
            }
        }

        $sessionKey = 'session:test';
        $cacheKey = 'cache:test';
        $queueKey = 'queue:test';

        Redis::connection('sessionredis')->set($sessionKey, 'session_value');
        Redis::connection('cache')->set($cacheKey, 'cache_value');
        Redis::connection('queues')->set($queueKey, 'queue_value');

        $this->info("Tenant {$tenant->id} - Session Key: " . Redis::connection('sessionredis')->get($sessionKey));
        $this->info("Tenant {$tenant->id} - Cache Key: " . Redis::connection('cache')->get($cacheKey));
        $this->info("Tenant {$tenant->id} - Queue Key: " . Redis::connection('queues')->get($queueKey));

        tenancy()->end();

        return Command::SUCCESS;
    }
}
