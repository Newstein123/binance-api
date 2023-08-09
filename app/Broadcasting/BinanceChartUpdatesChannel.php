<?php 

namespace App\Broadcasting;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Binance\API;

class BinanceChartUpdatesChannel implements ShouldBroadcast
{
    use Dispatchable, SerializesModels;
    public $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function broadcastOn()
    {
        return new Channel('binance-chart-updates');
    }

    public function broadcastAs()
    {
        return 'binance-chart-update';
    }

    public function broadcastWith()
    {   
        return [
            'symbol' => 'BNBBTC',
            'chart' => $this->data,
        ];
    }
}
