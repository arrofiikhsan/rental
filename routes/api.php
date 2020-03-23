<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//petugas
Route::post('login','Controllerpetugas@login');
Route::post('register','Controllerpetugas@register');

//pelanggan
Route::post('tambahpelanggan','Controllerpelanggan@tambah')->middleware('jwt.verify');
Route::post('editpelanggan{id}','Controllerjenis@update')->middleware('jwt.verify');
Route::post('hapuspelanggan{id}','Controllerjenis@destroy')->middleware('jwt.verify');


//jenis cuci
Route::post('tambahjenis','Controllerjenis@tambah')->middleware('jwt.verify');
Route::post('editjenis{id}','Controllerjenis@update')->middleware('jwt.verify');
Route::post('hapusjenis{id}','Controllerjenis@destroy')->middleware('jwt.verify');
Route::get('tampiljenis{id}','Controllerjenis@update')->middleware('jwt.verify');
//transaksi
Route::post('tampiltransaksi','Controllertransaksi@show')->middleware('jwt.verify');
Route::post('tambahtransaksi','Controllertransaksi@tambah')->middleware('jwt.verify');
Route::post('edittransaksi{id}','Controllertransaksi@update')->middleware('jwt.verify');
Route::post('hapustransaksi{id}','Controllertransaksi@destroy')->middleware('jwt.verify');
//detail
Route::post('tambahdetail','Controllerdetail@tambah')->middleware('jwt.verify');
Route::post('editdetail{id}','Controllerdetail@update')->middleware('jwt.verify');
Route::post('showdetail','Controllerdetail@show')->middleware('jwt.verify');