<?php

Route::group(['module' => 'JenisAduan', 'middleware' => ['web'], 'namespace' => 'App\Modules\JenisAduan\Controllers'], function() {

    // Route::resource('JenisAduan', 'JenisAduanController');
    Route::get('master-jenis-aduan', 'JenisAduanController@index')->name('jenis-aduan.index');
    Route::get('master-jenis-aduan/create', 'JenisAduanController@getCreate')->name('jenis-aduan.create');
    Route::post('master-jenis-aduan/create', 'JenisAduanController@postCreate')->name('jenis-aduan.create.action');
    Route::get('master-jenis-aduan/edit/{id}', 'JenisAduanController@getEdit')->name('jenis-aduan.edit');
    Route::post('master-jenis-aduan/edit/action', 'JenisAduanController@postEdit')->name('jenis-aduan.edit.action');
    Route::post('master-jenis-aduan/delete', 'JenisAduanController@postDelete')->name('jenis-aduan.delete');

});
