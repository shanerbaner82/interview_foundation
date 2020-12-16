<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth'], function() {
    Route::get('token', 'CheckForTokenController');
    Route::put('token', 'AddTokenController');
    Route::delete('token', 'DeleteTokenController');
});
