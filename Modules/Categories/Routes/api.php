<?php

use Illuminate\Support\Facades\Route;

Route::get('/select/categories', 'SelectController@categories')->name('categories.select');

Route::get('categories/count', 'Api\CategoryController@count')->name('categories.count');
Route::apiResource('categories', 'Api\CategoryController')->only('index', 'show');
