<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Stancl\Tenancy\Contracts\Domain;
use Stancl\Tenancy\Resolvers\DomainTenantResolver;

class InvalidateDomainTenantResolverCache implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        protected Domain $domain,
    ) {}

    /**
     * Execute the job.
     */
    public function handle(DomainTenantResolver $resolver): void
    {
        $resolver->invalidateCache($this->domain->tenant);
    }
}
