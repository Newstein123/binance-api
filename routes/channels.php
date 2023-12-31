<?php

use Illuminate\Support\Facades\Broadcast;
use BeyondCode\LaravelWebSockets\Facades\WebSocketsRouter;
use App\Broadcasting\BinanceChartUpdatesChannel;
use App\Broadcasting\GenerateKeyChannel;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

// Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
//     return (int) $user->id === (int) $id;
// });
WebSocketsRouter::channel('binance-chart-updates', BinanceChartUpdatesChannel::class);
WebSocketsRouter::channel('generate-keys', GenerateKeyChannel::class);
