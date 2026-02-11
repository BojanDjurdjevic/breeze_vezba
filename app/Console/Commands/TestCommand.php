<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        /*
        $response = Http::get("https://reqres.in/api/users/2");
        dd($response->json());
        */

        $response = Http::get("http://api.weatherapi.com/v1/current.json", [
            "key" => '064b479180f148699a5223554261102',
            "q" => 'Novi Sad'
        ]);
        dd($response->json());
    }
}
