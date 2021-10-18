<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('pegawai','PegawaiController@Apiget');
Route::get('pegawai/{ID}','PegawaiController@ApigetDetail');
Route::post('pegawai','PegawaiController@Apipost');
Route::put('pegawai/{ID}','PegawaiController@Apiput');
Route::delete('pegawai/{ID}','PegawaiController@Apidelete');

Route::post('absensi','AbsensiController@store');
