<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'guest'], function() {
    Route::post('register', 'Auth\RegisterController@register');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('verification/verify/{user}', 'Auth\VerificationController@verify')->name('verify');
    Route::post('verification/resend', 'Auth\VerificationController@resend');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');
});

Route::group(['middleware' => 'auth'], function() {
    Route::post('logout', 'Auth\\LoginController@logout');
    Route::get('profile', 'Users\\ProfileController@show');

    // Setting user
    Route::put('settings/profile', 'Users\\SettingController@updateProfile');
    Route::put('settings/password', 'Users\\SettingController@updatePassword');
});
