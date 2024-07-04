<?php

use Illuminate\Support\Facades\Route;

Route::middleware('dashboard')->prefix('dashboard')->as('dashboard.')->group(function () {
    Route::resource('categories', 'Dashboard\CategoryController');
});
