<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

// Route::get('/', function () {
//     return view('index');
// });

Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);
Route::resource('user', '\App\Http\Controllers\UsersController');
Route::resource('estimasi', 'EstimatesController');
Route::resource('logistik', 'LogisticsController');
Route::resource('penawaran', 'OffersController');
Route::resource('spk-asuransi', 'InsurancesController');