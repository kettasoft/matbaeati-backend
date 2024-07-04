<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
    |--------------------------------------------------------------------------
    | API Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register API routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | is assigned the "api" middleware group. Enjoy building your API!
    |
*/

Route::post('/register', 'Api\RegisterController')->name('account.register');
Route::post('/login', 'Api\LoginController')->name('account.login');

Route::post('/password/forget', 'Api\ResetPasswordController@forget')->name('account.password.forget');
Route::post('/password/code', 'Api\ResetPasswordController@code')->name('account.password.code');
Route::post('/password/reset', 'Api\ResetPasswordController@reset')->name('account.password.reset');

Route::post('verification/send', 'Api\EmailVerificationController@send')->name('verification.send');
Route::post('verification/resend', 'Api\EmailVerificationController@send')->name('verification.resend');
Route::post('verification/verify', 'Api\EmailVerificationController@verify')->name('verification.verify');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('profile', 'Api\ProfileController@show')->name('account.profile.show');
    Route::post('profile', 'Api\ProfileController@update')->name('account.profile.update');

    Route::get('account/exist', 'Api\ProfileController@exist')->name('account.exist');
    Route::post('account/preferred-locale', 'Api\ProfileController@preferredLocale')->name('account.preferred.locale');

    Route::post('logout', 'Api\ProfileController@logout')->name('account.logout');

    Route::get('account/check', 'Api\ProfileController@check')->name('account.check');
});
