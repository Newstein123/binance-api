<?php 
$api_key = "IFl3LwvrktDJ6kTYcz8uD9jsBJgRKpdE3tPjJaFJkaVh4geIIuxTuSBLlsbQVIXp";
$secret_key = "8xzQVqIIkKwUs34bWbU9r8H6WiZdIsEbiyNrnJxsklojcgsyetnSIaPbZzdJe69d";
$api = new Binance\API($api_key, $secret_key);
// $ticker = $api->prices();
// $btn = "";
// $eth = "";
// foreach ($ticker as $key => $value) {
//     if($key == "BTCUSDT") {
//         $btn = $value;
//     } elseif($key == "ETHUSDT") {
//         $eth = $value;
//     }
// }

// $array = (
//     "BTC" => $btn,
//     "ETH" => $eth,
// )

$api->chart(["BNBBTC"], "15m", function($api, $symbol, $chart) {
	echo "{$symbol} chart update\n";
	print_r($chart);
});