<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', [App\Http\Controllers\PublicController::class, 'welcome'])->name('welcome');
Route::get('user-login', [App\Http\Controllers\PublicController::class, 'userlogin'])->name('user-login');

Route::get('userRegister', [App\Http\Controllers\PublicController::class, 'userRegister'])->name('userRegister');

Route::post('user-login', [App\Http\Controllers\PublicController::class, 'user_login']);
Route::post('user-register', [App\Http\Controllers\PublicController::class, 'customer_register']);

Route::post('user-logout', [App\Http\Controllers\PublicController::class, 'user_logout']);


Route::get('sendMail', [App\Http\Controllers\PublicController::class, 'sendMail']);
Route::post('contact', [App\Http\Controllers\contactUs::class, 'contact']);

Auth::routes();

Route::get('locale', [App\Http\Controllers\LocalizationController::class, 'getLang']);

Route::get('locale/{lang}', [App\Http\Controllers\LocalizationController::class, 'setLang'])->name('setlang');

Route::post('book', [App\Http\Controllers\PublicController::class, 'book'])->middleware('auth_user');
Route::get('booking-history/{id}', [App\Http\Controllers\PublicController::class, 'booking_history'])->middleware('auth_user')->name('frontend.booking_history');

