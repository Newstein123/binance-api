<?php

namespace App\Console\Commands;

use Binance\API;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Broadcast;
use App\Broadcasting\BinanceChartUpdatesChannel;

class FetchPrice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:price';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        while(true)  {
            // $response = Http::get("http://localhost:8000/api/changed-price"); // Replace with your domain
            // $apiData = $response->json();
            $api_key = "IFl3LwvrktDJ6kTYcz8uD9jsBJgRKpdE3tPjJaFJkaVh4geIIuxTuSBLlsbQVIXp";
            $secret_key = "8xzQVqIIkKwUs34bWbU9r8H6WiZdIsEbiyNrnJxsklojcgsyetnSIaPbZzdJe69d";
            $api = new API($api_key, $secret_key);
            $bnb = $api->price("BNBUSDT");
            $btc = $api->price("BTCUSDT");
            $eth = $api->price("ETHUSDT");
            $shib = $api->price("SHIBUSDT");
            $akro = $api->price("AKROUSDT");
            $sol = $api->price("SOLUSDT");
            $array = array (
                'btc' => $btc,
                'bnb' => $bnb,
                'eth' => $eth,
                'shib' => $shib,
                'akro' => $akro,
                'sol' => $sol,
            );
            
            
            Broadcast::channel('binance-chart-updates', function ($user) {
                return true; // You might want to implement authorization logic here
            });
            
            broadcast(new BinanceChartUpdatesChannel($array))->toOthers();
        }
    }   
}
