<?php

use Illuminate\Support\Facades\Route;
//use Illuminate\Support\Facades\Route;

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
Route::get('/', [App\Http\Controllers\FrontendController::class, 'welcome']);
Route::get('about', [App\Http\Controllers\FrontendController::class, 'about']);

Auth::routes();


Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index_function']);
Route::post('/profile/password/edit/{id}', [App\Http\Controllers\ProfileController::class, 'password_edit_function']);
Route::post('/profile/photo/edit/{id}', [App\Http\Controllers\ProfileController::class, 'photo_edit_function']);



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/category', [App\Http\Controllers\CategoryController::class, 'index']);
Route::post('/catinsert', [App\Http\Controllers\CategoryController::class, 'insert']);
Route::get('/category/delete/{id}', [App\Http\Controllers\CategoryController::class, 'softdelete_function']);
Route::post('/category/mark/delete/', [App\Http\Controllers\CategoryController::class, 'mark_softdelete_function']);
Route::get('/category/all/delete/', [App\Http\Controllers\CategoryController::class, 'alldelete_function']);
Route::get('/category/remove/{id}', [App\Http\Controllers\CategoryController::class, 'remove_function']);
Route::get('/category/restore/{id}', [App\Http\Controllers\CategoryController::class, 'restore_function']);
Route::post('/category/update/{id}', [App\Http\Controllers\CategoryController::class, 'update_function']);

Route::get('/subcategory', [App\Http\Controllers\SubcategoryConroller::class, 'index']);
Route::post('/subinsert', [App\Http\Controllers\SubcategoryConroller::class, 'insert']);
Route::get('/subcategory/delete/{id}', [App\Http\Controllers\SubcategoryConroller::class, 'softdelete_function']);
Route::get('/subcategory/remove/{id}', [App\Http\Controllers\SubcategoryConroller::class, 'remove_function']);