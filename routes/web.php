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

// usage inside a laravel route
Route::get('/', function()
{
    $img = Image::make('photos/IMG_0714.jpg')->heighten(500);
    $img->text('Hello World', 200, 400, function($font) {
        $font->file('fonts/Open_Sans/OpenSans-Bold.ttf');
        $font->size(48);
        $font->color('#fdf6e3');
        $font->align('center');
        $font->valign('top');
    });
    return $img->response('jpg');
});

Route::get('/php', function () {
    return view('welcome');
});
