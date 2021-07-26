<?php

Route::group(['module' => 'JenisAduan', 'middleware' => ['api'], 'namespace' => 'App\Modules\JenisAduan\Controllers'], function() {

    Route::resource('JenisAduan', 'JenisAduanController');

});
