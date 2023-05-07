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

Route::post('get/city/data', [App\Http\Controllers\AjaxController::class, 'getCityData']);


Route::get('cart', [App\Http\Controllers\CartController::class, 'index_function']);
Route::get('cart/{name}', [App\Http\Controllers\CartController::class, 'index_function'])->name('couponuse');
Route::post('cart/add/{id}', [App\Http\Controllers\CartController::class, 'add_function']);

Auth::routes();


Route::get('profile', [App\Http\Controllers\ProfileController::class, 'index_function']);
Route::post('profile/password/edit/{id}', [App\Http\Controllers\ProfileController::class, 'password_edit_function']);
Route::post('profile/photo/edit/{id}', [App\Http\Controllers\ProfileController::class, 'photo_edit_function']);



Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('category', [App\Http\Controllers\CategoryController::class, 'index']);
Route::post('catinsert', [App\Http\Controllers\CategoryController::class, 'insert']);
Route::get('category/delete/{id}', [App\Http\Controllers\CategoryController::class, 'softdelete_function']);
Route::post('category/mark/delete/', [App\Http\Controllers\CategoryController::class, 'mark_softdelete_function']);
Route::get('category/all/delete/', [App\Http\Controllers\CategoryController::class, 'alldelete_function']);
Route::get('category/remove/{id}', [App\Http\Controllers\CategoryController::class, 'remove_function']);
Route::get('category/restore/{id}', [App\Http\Controllers\CategoryController::class, 'restore_function']);
Route::post('category/update/{id}', [App\Http\Controllers\CategoryController::class, 'update_function']);

Route::get('subcategory', [App\Http\Controllers\SubcategoryConroller::class, 'index']);
Route::post('subinsert', [App\Http\Controllers\SubcategoryConroller::class, 'insert']);
Route::get('subcategory/delete/{id}', [App\Http\Controllers\SubcategoryConroller::class, 'softdelete_function']);
Route::get('subcategory/remove/{id}', [App\Http\Controllers\SubcategoryConroller::class, 'remove_function']);



Route::get('product/loop', [App\Http\Controllers\ProductController::class, 'index_function']);
Route::post('product/insert', [App\Http\Controllers\ProductController::class, 'insert_function']);
Route::get('product/open/{id}', [App\Http\Controllers\ProductController::class, 'single_function']);
Route::get('product/category/{id}', [App\Http\Controllers\ProductController::class, 'category_function']);
Route::get('product/delete/{id}', [App\Http\Controllers\ProductController::class, 'delete_function']);



Route::get('cupon', [App\Http\Controllers\CuponController::class, 'index_function'])->name('cupon');
Route::post('cupon/insert', [App\Http\Controllers\CuponController::class, 'insert_function'])->name('cuponinsert');



Route::get('checkout', [App\Http\Controllers\CheckoutController::class, 'index_function']);
Route::post('checkout/payment', [App\Http\Controllers\CheckoutController::class, 'payment_function']);
Route::post('checkout/payment/offline', [App\Http\Controllers\CheckoutController::class, 'offline_payment_function'])->name('checkoutcompleteoffline');
Route::get('checkout/payment/online', [App\Http\Controllers\CheckoutController::class, 'online_payment_function'])->name('checkoutcompleteonline');




Route::get('users/loop', [App\Http\Controllers\UserController::class, 'all_user']);
Route::get('payment', [App\Http\Controllers\PaymentController::class, 'index_function']);