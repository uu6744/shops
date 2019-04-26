<?php

use Illuminate\Http\Request;

Route::get('/',function(){
    echo 22;
});
Route::prefix('admin')->group(function () {
    Route::post('/add','Admin\ZadminController@add');
    Route::post('/update','Admin\ZadminController@update');
    Route::post('/del','Admin\ZadminController@del');
    Route::post('/details','Admin\ZadminController@details');
});
Route::prefix('menu')->group(function () {
    Route::post('/add','Admin\ZmenuController@add');
    Route::post('/update','Admin\ZmenuController@update');
    Route::post('/del','Admin\ZmenuController@del');
    Route::post('/details','Admin\ZmenuController@details');
    Route::post('/list','Admin\ZmenuController@list');
    Route::post('/getchildren','Admin\ZmenuController@getchildren');
    
});
