<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\WaterfallController;
use App\Http\Controllers\Web\CityController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/waterfalls', [WaterfallController::class, 'showWaterfalls']);

Route::get('/waterfalls/{id}', [WaterfallController::class, 'showWaterfall']);

Route::get('/{country_name}/waterfalls/{slug}', [CityController::class, 'show']);