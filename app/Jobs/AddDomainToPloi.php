<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AddDomainToPloi implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $domain;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Domain $domain)
    {
        $this->domain = $domain;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        ploi()->addDomain($this->domain);
    }
}
