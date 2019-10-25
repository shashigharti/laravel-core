<?php


Route::group(['prefix' => config('core.frw.api'), 'as' => 'api.', 'group' => 'API Users'], function () {
    Route::resource('users', '\Robust\Admin\Controllers\API\UserController');
    Route::get('agents','\Robust\Admin\Controllers\API\UserController@getAgents');
});
