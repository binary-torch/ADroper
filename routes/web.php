<?php

Route::get('/', ['uses' => 'PageController@home'])->name('home');
Route::get('/about', ['uses' => 'PageController@about'])->name('about.index');
Route::get('/privacy', ['uses' => 'PageController@privacy'])->name('privacy.index');
Route::get('/terms', ['uses' => 'PageController@terms'])->name('terms.index');

Auth::routes();

Route::group(['prefix' => '/portal', 'middleware' => 'auth'], function(){
    Route::get('/', ['uses' => 'PortalController@index'])->name('portal.index');
});