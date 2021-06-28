<?php

Route::group(['module' => 'Laporan', 'middleware' => ['web','prevent-back-history'], 'namespace' => 'App\Modules\Laporan\Controllers'], function() {

    Route::get('laporan', 'LaporanController@index')->name('laporan.index');
    
    Route::get('laporan/insert', 'LaporanController@getCreate')->name('laporan.insert');
    Route::post('laporan/insert-action', 'LaporanController@postCreate')->name('laporan.insert.action');
    Route::get('laporan/edit/{id}', 'LaporanController@getEdit')->name('laporan.edit');
    Route::post('laporan/edit-action', 'LaporanController@postEdit')->name('laporan.edit.action');
    Route::get('laporan/details/{id}', 'LaporanController@getDetails')->name('laporan.details');
    Route::get('laporan/filter-cetak-excel', 'LaporanController@getCetakExcel')->name('laporan.get-cetak-excel');
    Route::post('laporan/cetak-excel', 'LaporanController@postCetakExcel')->name('laporan.cetak-excel');
    Route::post('laporan/delete/{id}', 'LaporanController@postDelete')->name('laporan.delete');
    Route::get('laporan/add-pasien', 'LaporanController@add_pasien')->name('laporan.add-pasien');
    Route::post('laporan/add-pasien-action', 'LaporanController@add_pasien_action')->name('laporan.add-pasien-action');
    Route::get('laporan/add-nik', 'LaporanController@add_nik')->name('laporan.add-nik');
    Route::post('laporan/hapus-pasien', 'LaporanController@hapus_pasien')->name('laporan.add-hapus-pasien');

    Route::post('laporan/get_kota', 'LaporanController@getKota')->name('get-kota');
    Route::post('laporan/get_kecamatan', 'LaporanController@getKecamatan')->name('get-kecamatan');
    Route::post('laporan/get_kelurahan', 'LaporanController@getKelurahan')->name('get-kelurahan');

    Route::post('laporan/load-data', 'LaporanController@loadDataTables')->name('load-data');
});
