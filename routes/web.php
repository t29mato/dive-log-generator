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
    $img->text('Hello Would', 240, 100, function($font) {
        $font->file('foo/bar.ttf');
        $font->size(50);
        $font->color('#fdf6e3');
        $font->align('center');
        $font->valign('top');
    });
    return $img->response('jpg');
});
