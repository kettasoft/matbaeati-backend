<?php

use Illuminate\Support\Facades\Route;

Route::get('/select/countries', 'SelectController@countries')->name('countries.select');
Route::get('/select/cities', 'SelectController@cities')->name('cities.select');

Route::apiResource('countries', 'Api\CountryController')->only('index', 'show');
Route::get('country/default', 'Api\CountryController@default')->name('countries.default');

Route::get('cities/{country}', 'Api\CityController@index')->name('cities.index');
// Route::get('regions/{city}', 'Api\RegionController@index')->name('regions.index');

//Route::get('/get/countries', 'SelectController@getCountries')->name('countries.get');
Route::get('/get/cities/{country}', 'SelectController@getCities')->name('cities.get');
