<?php

Route::get('/', ['uses' => 'PageController@home'])->name('home');
Route::get('/about', ['uses' => 'PageController@about'])->name('about.index');
Route::get('/privacy', ['uses' => 'PageController@privacy'])->name('privacy.index');
Route::get('/terms', ['uses' => 'PageController@terms'])->name('terms.index');

Auth::routes();

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Route::group(['prefix' => '/portal', 'middleware' => 'auth'], function(){
    Route::get('/', ['uses' => 'PortalController@index'])->name('portal.index');
    Route::post('/applications', ['uses' => 'PortalController@applications']);

    Route::group(['prefix' => '/application'], function(){
        Route::get('/create', ['uses' => 'ApplicationController@create'])->name('portal.application.create');
        Route::post('/store', ['uses' => 'ApplicationController@store']);
        Route::post('/types', ['uses' => 'ApplicationController@types']);
    });
    
    Route::group(['prefix' => '/college'], function(){
        Route::get('/all', ['uses' => 'CollegeController@all']);
        Route::post('/courses', ['uses' => 'CollegeController@courses']);
    });
});