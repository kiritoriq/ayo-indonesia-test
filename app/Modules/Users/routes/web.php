<?php

Route::group(['module' => 'Users', 'middleware' => ['web','prevent-back-history'], 'namespace' => 'App\Modules\Users\Controllers'], function() {

    Route::get('user', 'UsersController@index')->name('users.index');
    Route::get('user/create', 'UsersController@getCreate')->name('users.create');
    Route::post('user/create-action', 'UsersController@postCreate')->name('users.create.action');

});
