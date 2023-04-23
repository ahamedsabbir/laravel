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
Route::get('/', [App\Http\Controllers\FrontendController::class, 'welcome']);
Route::get('about', [App\Http\Controllers\FrontendController::class, 'about']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/category', [App\Http\Controllers\CategoryController::class, 'index']);
Route::post('/catinsert', [App\Http\Controllers\CategoryController::class, 'insert']);
Route::get('/category/delete/{id}', [App\Http\Controllers\CategoryController::class, 'remove']);


Route::get('/subcategory', [App\Http\Controllers\SubcategoryConroller::class, 'index']);
Route::post('/subinsert', [App\Http\Controllers\SubcategoryConroller::class, 'insert']);
Route::get('/subcategory/delete/{id}', [App\Http\Controllers\SubcategoryConroller::class, 'remove']);