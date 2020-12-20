<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth'], function() {
    Route::get('token', 'Token\CheckForTokenController')->name('token.get');
    Route::put('token', 'Token\AddTokenController')->name('token.put');
    Route::delete('token', 'Token\DeleteTokenController')->name('token.delete');
    Route::get('stars', 'Stars\StarsController')->name('stars.get');
});
