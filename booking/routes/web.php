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
Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('mail/send', [App\Http\Controllers\MailController::class, 'send'])->name('mail.send');
Route::get('/confirm_email/{id}', [App\Http\Controllers\MailController::class, 'confirm'])->name('confirm');

Route::post('/search', [App\Http\Controllers\SearchController::class, 'index'])->name('search');
Route::post('/search/filter', [App\Http\Controllers\SearchController::class, 'filter'])->name('search.filter');
Route::get('/search/show/{id}/{date_in}/{date_out}/{person}', [App\Http\Controllers\SearchController::class, 'show'])->name('search.show');

Route::group(['middleware' => 'auth'], function() {

Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
Route::post('/profile/save', [App\Http\Controllers\ProfileController::class, 'save'])->name('profile.save');

Route::get('/reservations', [App\Http\Controllers\ReservationController::class, 'index'])->name('reservations');
Route::get('/reservations/show/{id}', [App\Http\Controllers\ReservationController::class, 'show'])->name('reservations.show');
Route::get('/reservations/cancel/{id}', [App\Http\Controllers\ReservationController::class, 'cancel'])->name('reservations.cancel');
Route::get('/reservations/list', [App\Http\Controllers\ReservationController::class, 'list'])->name('reservations.list')->middleware('owner');
Route::get('/reservations/confirm/{id}', [App\Http\Controllers\ReservationController::class, 'confirm'])->name('reservations.confirm')->middleware('owner');
Route::get('/reservations/cancel_owner/{id}', [App\Http\Controllers\ReservationController::class, 'cancel_owner'])->name('reservations.cancel_owner')->middleware('owner');
Route::get('/reservations/end/{id}', [App\Http\Controllers\ReservationController::class, 'end'])->name('reservations.end')->middleware('owner');
Route::get('/reservations/add/{id}/{date_in}/{date_out}/{person}', [App\Http\Controllers\ReservationController::class, 'create'])->name('reservations.add');
Route::get('/reservations/create/{id}', [App\Http\Controllers\FeedbackController::class, 'create'])->name('feedback.new');


Route::resource('property', \App\Http\Controllers\PropertyController::class)->middleware('owner');
Route::get('/property/category/{id}', [App\Http\Controllers\CategoryController::class, 'index'])->middleware('owner')->name('category.index');

Route::get('/category/create/{property_id}', [App\Http\Controllers\CategoryController::class, 'create'])->name('category.create')->middleware('owner');
Route::post('/category/store', [App\Http\Controllers\CategoryController::class, 'store'])->name('category.store')->middleware('owner');
Route::post('/category/update/{id}', [App\Http\Controllers\CategoryController::class, 'update'])->name('category.update')->middleware('owner');
Route::get('/category/photo/{id}', [App\Http\Controllers\CategoryController::class, 'photo'])->name('category.photo')->middleware('owner');
Route::get('/category/photo_delete/{path}/{id}', [App\Http\Controllers\CategoryController::class, 'photo_delete'])->name('category.photo_delete')->middleware('owner');
Route::post('/category/photo_add/{category_id}', [App\Http\Controllers\CategoryController::class, 'photo_add'])->name('category.photo_add')->middleware('owner');
Route::get('/category/show/{id}', [App\Http\Controllers\CategoryController::class, 'show'])->name('category.show')->middleware('owner');
Route::delete('/category/destroy/{id}/{property_id}', [App\Http\Controllers\CategoryController::class, 'destroy'])->name('category.destroy')->middleware('owner');

Route::get('/feedback', [App\Http\Controllers\FeedbackController::class, 'index'])->name('feedback');
Route::post('/feedback', [App\Http\Controllers\FeedbackController::class, 'store'])->name('feedback.store');
Route::get('/feedback/property/{id}', [App\Http\Controllers\FeedbackController::class, 'property'])->name('feedback.property')->middleware('owner');




});
Route::get('/city',[\App\Http\Controllers\CityController::class,'index'])->name('city');
Route::get('/type/meal', [App\Http\Controllers\TypeController::class, 'meal']);
Route::get('/type/bed', [App\Http\Controllers\TypeController::class, 'bed']);
Route::get('/type/property', [App\Http\Controllers\TypeController::class, 'property']);
Route::get('/type/facilities', [App\Http\Controllers\TypeController::class, 'facilities']);
