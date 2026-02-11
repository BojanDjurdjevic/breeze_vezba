<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GetRealWeather extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weather:get-real';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'To sync real life weather using Open API';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        
    }
}
