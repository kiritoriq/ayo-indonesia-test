<?php

Route::group(['module' => 'Home', 'middleware' => ['web','prevent-back-history'], 'namespace' => 'App\Modules\Home\Controllers'], function() {

    Route::get('dashboard', 'HomeController@index')->name('dashboard.index');

    Route::post('laporan/load-data-rs', 'HomeController@loadDataTablesRS')->name('load-data-rs');
    Route::post('laporan/load-data-puskesmas', 'HomeController@loadDataTablesPuskesmas')->name('load-data-puskesmas');

});
