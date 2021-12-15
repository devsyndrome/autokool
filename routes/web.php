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
Route::get('logistik/part/{id}', '\App\Http\Controllers\LogisticsController@part');
Route::get('logistik/jasa/{id}', '\App\Http\Controllers\LogisticsController@jasa');
Route::get('logistik/detail/{id}', '\App\Http\Controllers\LogisticsController@detail');
Route::get('penawaran/detail/{id}', '\App\Http\Controllers\OffersController@detail');
Route::get('penawaran/cetak', '\App\Http\Controllers\OffersController@cetak');
Route::get('asuransi/part/{id}', '\App\Http\Controllers\AsuransiController@part');
Route::get('asuransi/jasa/{id}', '\App\Http\Controllers\AsuransiController@jasa');
Route::get('asuransi/detail/{id}', '\App\Http\Controllers\AsuransiController@detail');
Route::get('penawaran-hpp/detail/{id}', '\App\Http\Controllers\PenawaranHppController@detail');
Route::get('spk-hpp/detail/{id}', '\App\Http\Controllers\SpkHppController@detail');
Route::resource('user', '\App\Http\Controllers\UsersController');
Route::resource('estimasi', '\App\Http\Controllers\EstimatesController');
Route::resource('logistik', '\App\Http\Controllers\LogisticsController');
Route::resource('penawaran', '\App\Http\Controllers\OffersController');
Route::resource('asuransi', '\App\Http\Controllers\AsuransiController');
Route::resource('part', '\App\Http\Controllers\EstimatePartsController');
Route::resource('jasa', '\App\Http\Controllers\EstimateServicesController');
Route::resource('penawaran-hpp', '\App\Http\Controllers\PenawaranHppController');
Route::resource('spk-hpp', '\App\Http\Controllers\SpkHppController');