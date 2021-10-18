<?php

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

Route::get('/', function () {
    // return view('welcome');
    return view('absensi');
});

Route::group(
	['prefix' => 'admin', 'middleware' => ['auth']],
	function () {
        Route::resource('pegawai','PegawaiController');
// Route::get('pegawai/search/filter','PegawaiController@indexSearch');
Route::get('reports/pegawai', 'PegawaiController@exportCSV');
Route::get('absensi','AbsensiController@index');
Route::get('reports/absensi','AbsensiController@exportCSV');
    }    
);

Route::post('absensi','AbsensiController@strore');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
