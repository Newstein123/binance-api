<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Broadcast;
use App\Broadcasting\BinanceChartUpdatesChannel;

class BroadcastHelloWorld extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'broadcast:hello-world';

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
        Broadcast::channel('binance-chart-updates', function ($user) {
            return true; // You might want to implement authorization logic here
        });
        
        broadcast(new BinanceChartUpdatesChannel("min thet paing"))->toOthers(); 
    }
    // Broadcast::channel('binance-chart-updates', function ($user) {
        //     return true; // You might want to implement authorization logic here
        // });
        
        // broadcast(new BinanceChartUpdatesChannel("min thet paing"))->toOthers();  
}
