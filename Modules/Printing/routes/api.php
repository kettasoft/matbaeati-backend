<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->prefix('printing')->group(function () {
    Route::apiResource('/', 'Api\PrintingController');
});

