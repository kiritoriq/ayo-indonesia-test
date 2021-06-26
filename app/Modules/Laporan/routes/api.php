<?php

Route::group(['module' => 'Laporan', 'middleware' => ['api'], 'namespace' => 'App\Modules\Laporan\Controllers'], function() {

    Route::resource('Laporan', 'LaporanController');

});
