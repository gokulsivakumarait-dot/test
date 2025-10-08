<?php

use App\Http\Controllers\AuthController;
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

Route::controller(AuthController::class)->group(function(){
    Route::get('/', 'loginshow');
    Route::get('login', 'loginshow');
    Route::get('register', 'registershow');
    Route::get('dashboard','index')->name('dashboard');
    Route::get('forgot-password', 'forgotpasswordshow')->name('forgot.password');

    Route::post('register', 'register')->name('register');
    Route::post('login', 'login')->name('login');
    Route::get('logout', 'logout')->name('logout');
    Route::post('forgot-password', 'forgotpassword')->name('forgot.password');
    Route::post('reset-password', 'resetpassword')->name('reset.password');

});
