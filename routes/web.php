<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('admin-members-index');
});

Route::any('/{default?}', function() {
    return redirect()->route('admin-members-index');
});

Auth::routes();

Route::group([/*'middleware' => ['auth'], */'prefix' => 'admin'], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard-analytics');

    Route::group([
        'prefix' => 'members',
    ], function () {
        Route::get('/', [App\Http\Controllers\MemberController::class, 'index'])->name('admin-members-index');
    });
});