<?php

use Illuminate\Support\Facades\Route;
use Modules\Printing\Http\Controllers\PrintingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group([], function () {
    Route::resource('printing', PrintingController::class)->names('printing');
});
