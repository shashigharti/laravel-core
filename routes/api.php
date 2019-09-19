<?php
Route::group(['as' => 'newuser.'], function () {
    Route::post('login', 'API\UserController@login');
    Route::post('register', 'API\UserController@register');
});


// Auth restricted apis
Route::group(['as' => 'admin.', 'middleware' => ['auth']], function () {
    Route::post('details', 'API\UserController@details');
});

Route::get('/media/{id}','HomeController@getThumbnail');
Route::get('/images/all','HomeController@getMedia');
Route::post('/upload','HomeController@uploadMedia');
