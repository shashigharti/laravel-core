<?php
Route::group(['prefix' => 'market',
'as' => 'website.realestate.market.',
'group' => 'Market Survey'],
function () {
    Route::get('survey', [
        'name' =>'Market Survey',
        'as' => 'survey',
        'uses' => '\Robust\RealEstate\Controllers\Website\MarketSurveyController@index'
    ]);
});
