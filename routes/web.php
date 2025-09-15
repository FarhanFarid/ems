<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArrangementController;


Route::get('/', function () {
    return view('apps.dashboard');
});

Route::get('/', [ArrangementController::class, 'index'])->name('apps.index');

Route::group(['prefix' => 'apps'], function () {
    Route::get('/getarrangementlist', [ArrangementController::class, 'getArrangmentList'])->name('apps.getarrangementlist');
    Route::post('/savearrangement', [ArrangementController::class, 'saveArrangment'])->name('apps.savearrangement');
});
