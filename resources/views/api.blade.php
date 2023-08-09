<?php 
$api_key = "IFl3LwvrktDJ6kTYcz8uD9jsBJgRKpdE3tPjJaFJkaVh4geIIuxTuSBLlsbQVIXp";
$secret_key = "8xzQVqIIkKwUs34bWbU9r8H6WiZdIsEbiyNrnJxsklojcgsyetnSIaPbZzdJe69d";
$api = new Binance\API($api_key, $secret_key);
$ticker = $api->prices();
dd($ticker);