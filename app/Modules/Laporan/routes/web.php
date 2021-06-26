<?php

Route::group(['module' => 'Laporan', 'middleware' => ['web','prevent-back-history'], 'namespace' => 'App\Modules\Laporan\Controllers'], function() {

    Route::get('laporan', 'LaporanController@index')->name('laporan.index');
    
    Route::get('laporan/insert', 'LaporanController@getCreate')->name('laporan.insert');
    Route::post('laporan/insert-action', 'LaporanController@postCreate')->name('laporan.insert.action');

    Route::get('laporan/edit/{id}', 'LaporanController@getEdit')->name('laporan.edit');
    Route::post('laporan/edit-action', 'LaporanController@postEdit')->name('laporan.edit.action');

    Route::get('laporan/details/{id}', 'LaporanController@getDetails')->name('laporan.details');

    Route::post('laporan/delete/{id}', 'LaporanController@postDelete')->name('laporan.delete');
});
