<?php

Route::group([
    'middleware' => ['web','prevent-back-history', 'auth'],
    'namespace' => 'Admin',
], function() {
    Route::resource('eventlog', EventLogController::class);
});