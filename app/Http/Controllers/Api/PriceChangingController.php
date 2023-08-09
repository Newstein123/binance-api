<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PriceChangingController extends Controller
{
    public function index(Request $request) {
        $symbol = $request->query('symbol', 'BTC');
        $price = $this->generateRandomPrice();
        
        return response()->json([
            'symbol' => $symbol,
            'price' => $price,
            'timestamp' => now(),
        ]);
    }

    private function generateRandomPrice()
    {
        return round(rand(50000, 60000) / 100, 2); // Generate a random price between 500 and 600
    }
}
