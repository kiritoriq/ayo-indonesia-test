<?php

Route::group(['module' => 'JenisAduan', 'middleware' => ['web'], 'namespace' => 'App\Modules\JenisAduan\Controllers'], function() {

    // Route::resource('JenisAduan', 'JenisAduanController');
    Route::get('master-jenis-aduan', 'JenisAduanController@index')->name('jenis-aduan.index');
    Route::get('master-jenis-aduan/create', 'JenisAduanController@getCreate')->name('jenis-aduan.create');

});
