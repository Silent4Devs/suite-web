<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

class ClearCacheCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:clearall';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Eliminar cache que causa bugs';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Artisan::call('optimize:clear');
        sleep(10);
        Artisan::call('cache:clear');
        Log::info('Cache cleared on:'.now()->format('d-m-Y H:i'));
    }
}
