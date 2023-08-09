<?php

namespace App\Http\Controllers;
use App\Broadcasting\BinanceChartUpdatesChannel;
use Illuminate\Support\Facades\Broadcast;
use Binance\API;

class BinanaceController extends Controller
{
    public function index() {
        // In a service provider's boot method or a controller
        Broadcast::channel('binance-chart-updates', function ($user) {
            return true; // You might want to implement authorization logic here
        });
        
        broadcast(new BinanceChartUpdatesChannel("hello world"))->toOthers();   
    }
}
