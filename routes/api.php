<?php

use App\Http\Controllers\Api\NoticiaApiController;
use App\Http\Controllers\Api\AuthApiController;

Route::post('/login', [AuthApiController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('noticias', NoticiaApiController::class);
    Route::post('/logout', [AuthApiController::class, 'logout']);
});
