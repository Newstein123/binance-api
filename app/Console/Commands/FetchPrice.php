<?php

namespace App\Console\Commands;

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
            $response = Http::get("http://localhost:8000/api/changed-price"); // Replace with your domain
            $apiData = $response->json();
            
            Broadcast::channel('binance-chart-updates', function ($user) {
                return true; // You might want to implement authorization logic here
            });
            
            broadcast(new BinanceChartUpdatesChannel($apiData))->toOthers();
        }
    }   
}
