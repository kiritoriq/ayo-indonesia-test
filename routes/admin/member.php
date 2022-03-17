<?php

Route::group([
    'middleware' => ['web','prevent-back-history', 'auth'],
    'namespace' => 'Admin',
], function() {
    Route::get('/member/get-org', [App\Http\Controllers\Admin\MemberController::class, 'getOrgBySportId'])->name('member.get-org');
    Route::resource('member', MemberController::class);
});