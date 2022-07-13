<?php

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

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('mail/send', [App\Http\Controllers\MailController::class, 'send'])->middleware('auth')->name('mail.send');
Route::get('/confirm_email/{id}', [App\Http\Controllers\MailController::class, 'confirm'])->name('confirm');

Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->middleware('auth')->name('profile');
Route::post('/profile/save', [App\Http\Controllers\ProfileController::class, 'save'])->middleware('auth')->name('profile.save');
Route::get('/reservations', [App\Http\Controllers\ProfileController::class, 'index'])->middleware('auth')->name('reservations');
