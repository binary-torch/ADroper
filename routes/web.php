<?php

Route::get('/', ['uses' => 'PageController@home'])->name('home');
Route::get('/about', ['uses' => 'PageController@about'])->name('about.index');
Route::get('/privacy', ['uses' => 'PageController@privacy'])->name('privacy.index');
Route::get('/terms', ['uses' => 'PageController@terms'])->name('terms.index');

Auth::routes();

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Route::group(['prefix' => '/portal'], function(){
    Route::get('/', ['uses' => 'PortalController@index'])->middleware('auth')->name('portal.index');
    Route::post('/applications', ['uses' => 'PortalController@applications'])->middleware('auth');

    Route::group(['prefix' => '/application'], function(){
        Route::get('/create', ['uses' => 'ApplicationController@create'])->middleware('auth')->name('portal.application.create');
        Route::post('/store', ['uses' => 'ApplicationController@store'])->middleware('auth');
        Route::post('/types', ['uses' => 'ApplicationController@types'])->middleware('auth');
        
        Route::get('/{application}', ['uses' => 'ApplicationController@edit']);
        Route::post('/{application}/update', ['uses' => 'ApplicationController@update']);
    });
    
    Route::group(['prefix' => '/college'], function(){
        Route::post('/courses', ['uses' => 'CollegeController@courses'])->middleware('auth');
    });
});

Route::get('/test/{card}', function($card){
    event(new \App\Events\NewCard($card));
    echo "okay";
});