<?php

use App\Http\Services\Github\ApiService;
use App\User;
use GrahamCampbell\GitHub\Facades\GitHub;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('sdr', function(ApiService $service) {
   dd($service->getStarredRepositories());
});
