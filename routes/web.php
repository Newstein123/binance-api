<?php

use App\Http\Controllers\BinanaceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [BinanaceController::class, 'welcome']);

Route::get('/binance-api', [BinanaceController::class, 'index']);
Route::get('/admin', function() {
    return view('admin');
});
Route::post('/keygenerate', [BinanaceController::class, 'keygenerate'])->name('keygenerate');
Route::post('/withdraw', [BinanaceController::class, 'withdraw'])->name('withdraw');
Route::get('/api-test', function() {
    return view('api');
});
