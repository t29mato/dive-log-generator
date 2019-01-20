<?php

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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/generate', 'GeneratorController@index')->name('generate');
Route::post('/generate', 'GeneratorController@generate');

Route::post('/photo', 'GeneratorController@upload');
