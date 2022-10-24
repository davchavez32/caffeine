<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BeverageController;
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

Route::get('/', [BeverageController::class, 'getBeverages']);

Route::get('getBeverages', [BeverageController::class, 'getBeverages'])->name('getBeverages');

Route::post('checkBeveragesConsumption', [BeverageController::class, 'checkBeveragesConsumption'])->name('checkBeveragesConsumption');
