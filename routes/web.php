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
require __DIR__.'/auth.php';
Route::get('/dashboard/admin','App\Http\Controllers\micrositioController@administrador')->middleware(['auth']);
Route::get('/dashboard/administrador','App\Http\Controllers\micrositioController@administrador')->middleware(['auth'])->name('dashboard-title');
Route::post('/dashboard/sucursal','App\Http\Controllers\micrositioController@sucursal')->name('sucursal');
Route::post('/search','App\Http\Controllers\micrositioController@search')->middleware(['auth'])->name('search');
Route::post('/certificado','App\Http\Controllers\micrositioController@certificado')->middleware(['auth'])->name('certificado');
Route::get('/alemi-casa-', function () {
    return redirect('/alemi-casa-&-capital');
});
Route::get('/{url}','App\Http\Controllers\micrositioController@broker');
Route::get('/pruebas/massupdate','App\Http\Controllers\micrositioController@massUpdate');

Route::post('/update','App\Http\Controllers\micrositioController@update')->name('update');
Route::post('/sendmail','App\Http\Controllers\micrositioController@sendMail')->name('sendMail');
Route::post('/sendmail2','App\Http\Controllers\micrositioController@sendMail2')->name('sendMail2');
Route::get('/export/all','App\Http\Controllers\Auth\RegisteredUserController@exportAll')->name('exportAll');
Route::get('/export/all2','App\Http\Controllers\Auth\RegisteredUserController@exportAll3')->name('exportAll');
