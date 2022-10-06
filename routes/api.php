<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'middleware' => 'auth:sanctum'
], function() {
    Route::post('qr', \App\Http\Controllers\CreateQrCodeController::class);
    Route::get('qrs', \App\Http\Controllers\GetQrCodesController::class);
    Route::delete('delete/qr/{id}', \App\Http\Controllers\DestroyQrCodeController::class);
});

Auth::routes();
