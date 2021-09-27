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
Route::get('estimasi/part/{id}', '\App\Http\Controllers\EstimatesController@part')->name('spart');
Route::get('estimasi/jasa/{id}', '\App\Http\Controllers\EstimatesController@jasa');
Route::get('estimasi/detail/{id}', '\App\Http\Controllers\EstimatesController@detail');
Route::resource('user', '\App\Http\Controllers\UsersController');
Route::resource('estimasi', '\App\Http\Controllers\EstimatesController');
Route::resource('logistik', '\App\Http\Controllers\LogisticsController');
Route::resource('penawaran', '\App\Http\Controllers\OffersController');
Route::resource('spk-asuransi', '\App\Http\Controllers\InsurancesController');
Route::resource('part', '\App\Http\Controllers\EstimatePartsController');
Route::resource('service', '\App\Http\Controllers\EstimateServicesController');