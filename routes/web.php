<?php

Auth::loginUsingId(1);

DB::listen(function ($query) {
//     var_dump($query->sql);
//     var_dump($query->time);
});

Route::get('/', ['uses' => 'PageController@home'])->name('home');
Route::get('/about', ['uses' => 'PageController@about'])->name('about.index');
Route::get('/privacy', ['uses' => 'PageController@privacy'])->name('privacy.index');
Route::get('/terms', ['uses' => 'PageController@terms'])->name('terms.index');

Auth::routes();

Route::group(['prefix' => '/portal', 'middleware' => 'auth'], function(){
    Route::get('/', ['uses' => 'PortalController@index'])->name('portal.index');
    
    Route::group(['prefix' => '/application'], function(){
        Route::get('/create', ['uses' => 'ApplicationController@create'])->name('portal.application.create');
        Route::post('/store', ['uses' => 'ApplicationController@store']);
        Route::post('/courses', ['uses' => 'ApplicationController@courses']);
        Route::post('/types', ['uses' => 'ApplicationController@types']);
    });
});

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
