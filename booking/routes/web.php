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
//Route::get('/property', [App\Http\Controllers\ProfileController::class, 'index'])->middleware('auth')->name('property');

Route::resource('property', \App\Http\Controllers\PropertyController::class)->middleware('auth');
Route::get('/test', [App\Http\Controllers\TestController::class, 'index']);


Route::get('/property/category/{id}', [App\Http\Controllers\CategoryController::class, 'index'])->middleware('auth')->name('category.index');
Route::get('/category/create/{property_id}', [App\Http\Controllers\CategoryController::class, 'create'])->middleware('auth')->name('category.create');
Route::post('/category/store', [App\Http\Controllers\CategoryController::class, 'store'])->middleware('auth')->name('category.store');
Route::post('/category/update/{id}', [App\Http\Controllers\CategoryController::class, 'update'])->middleware('auth')->name('category.update');
Route::get('/category/photo/{id}', [App\Http\Controllers\CategoryController::class, 'photo'])->middleware('auth')->name('category.photo');

Route::get('/category/show/{id}', [App\Http\Controllers\CategoryController::class, 'show'])->middleware('auth')->name('category.show');
Route::delete('/category/destroy/{id}/{property_id}', [App\Http\Controllers\CategoryController::class, 'destroy'])->middleware('auth')->name('category.destroy');
