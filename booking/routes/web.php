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
Route::get('/reservations', [App\Http\Controllers\ReservationController::class, 'index'])->middleware('auth')->name('reservations');
Route::get('/reservations/show/{id}', [App\Http\Controllers\ReservationController::class, 'show'])->middleware('auth')->name('reservations.show');
Route::get('/reservations/cancel/{id}', [App\Http\Controllers\ReservationController::class, 'cancel'])->middleware('auth')->name('reservations.cancel');
Route::get('/reservations/list', [App\Http\Controllers\ReservationController::class, 'list'])->middleware('auth')->name('reservations.list');
Route::get('/reservations/confirm/{id}', [App\Http\Controllers\ReservationController::class, 'confirm'])->middleware('auth')->name('reservations.confirm');
Route::get('/reservations/cancel_owner/{id}', [App\Http\Controllers\ReservationController::class, 'cancel_owner'])->middleware('auth')->name('reservations.cancel_owner');
Route::get('/reservations/end/{id}', [App\Http\Controllers\ReservationController::class, 'end'])->middleware('auth')->name('reservations.end');

//Route::get('/property', [App\Http\Controllers\ProfileController::class, 'index'])->middleware('auth')->name('property');

Route::resource('property', \App\Http\Controllers\PropertyController::class)->middleware('auth');
Route::get('/test', [App\Http\Controllers\TestController::class, 'index']);


Route::get('/property/category/{id}', [App\Http\Controllers\CategoryController::class, 'index'])->middleware('auth')->name('category.index');
Route::get('/category/create/{property_id}', [App\Http\Controllers\CategoryController::class, 'create'])->middleware('auth')->name('category.create');
Route::post('/category/store', [App\Http\Controllers\CategoryController::class, 'store'])->middleware('auth')->name('category.store');
Route::post('/category/update/{id}', [App\Http\Controllers\CategoryController::class, 'update'])->middleware('auth')->name('category.update');
Route::get('/category/photo/{id}', [App\Http\Controllers\CategoryController::class, 'photo'])->middleware('auth')->name('category.photo');
Route::get('/category/photo_delete/{path}/{id}', [App\Http\Controllers\CategoryController::class, 'photo_delete'])->middleware('auth')->name('category.photo_delete');
Route::post('/category/photo_add/{category_id}', [App\Http\Controllers\CategoryController::class, 'photo_add'])->middleware('auth')->name('category.photo_add');

Route::get('/category/show/{id}', [App\Http\Controllers\CategoryController::class, 'show'])->middleware('auth')->name('category.show');
Route::delete('/category/destroy/{id}/{property_id}', [App\Http\Controllers\CategoryController::class, 'destroy'])->middleware('auth')->name('category.destroy');

Route::get('/reservations/create/{id}', [App\Http\Controllers\FeedbackController::class, 'create'])->middleware('auth')->name('feedback.new');

Route::post('/search', [App\Http\Controllers\SearchController::class, 'index'])->name('search');
Route::post('/search/filter', [App\Http\Controllers\SearchController::class, 'filter'])->name('search.filter');

Route::get('/feedback', [App\Http\Controllers\FeedbackController::class, 'index'])->middleware('auth')->name('feedback');
Route::post('/feedback', [App\Http\Controllers\FeedbackController::class, 'store'])->middleware('auth')->name('feedback.store');
Route::get('/feedback/property/{id}', [App\Http\Controllers\FeedbackController::class, 'property'])->middleware('auth')->name('feedback.property');
Route::get('/city',[\App\Http\Controllers\CityController::class,'index'])->name('city');

