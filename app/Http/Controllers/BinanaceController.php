<?php

namespace App\Http\Controllers;
use Binance\API;
use App\Models\SharedKey;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Broadcasting\GenerateKeyChannel;
use Illuminate\Support\Facades\Broadcast;
use App\Broadcasting\BinanceChartUpdatesChannel;

class BinanaceController extends Controller
{
    public function index() {
        // In a service provider's boot method or a controller
        Broadcast::channel('binance-chart-updates', function ($user) {
            return true; // You might want to implement authorization logic here
        });
        
        broadcast(new BinanceChartUpdatesChannel("hello world"))->toOthers();   
    }

    public function keygenerate() {
        $shared_key = Str::random(16);
        broadcast(new GenerateKeyChannel($shared_key))->toOthers();
        try {
            $shared_key= SharedKey::updateOrCreate(
                ['user_id' => 1,],
                ['key' => $shared_key, 'user_id' => 1, 'valid' => 1, 'created_at' => now(), 'updated_at' => now()]
            );
            if($shared_key) {
                return response()->json([
                    'success' => true,
                ]);
            } else {
                return response()->json([
                    'success' => false,
                ]);
            }
        } catch (\Exception $e) {      
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function welcome() { 
       return view('welcome');
    }

    public function withdraw(Request $request) {
        $key = $request->key;
        $shared_key = SharedKey::where('key', $key)
                    ->where('created_at', '>', now()->subMinutes(1))
                    ->exists();
        if($shared_key) {
            broadcast(new GenerateKeyChannel("Some body make a withdraw. Please verify this"))->toOthers();
            return response()->json([
                "success" => true,
                "data" => $shared_key,
                "message" => "Withdrawal Successful, wait for admin reply.",
            ]);
        } else {
            return response()->json([
                "success" => false,
                "message" => "Withdrawal Failed, generate key agiain",
            ]);
        }
    }
}
