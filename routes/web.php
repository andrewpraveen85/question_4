<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('login-confirm', [CustomAuthController::class, 'loginConfirm'])->name('login.confirm'); 
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');
Route::get('dashboard', [CustomAuthController::class, 'dashboard'])->name('dashboard');

Route::get('restaurant-index', [CustomAuthController::class, 'restaurantIndex'])->name('restaurant.index');
Route::get('restaurant-insert', [CustomAuthController::class, 'restaurantInsert'])->name('restaurant.insert');
Route::post('restaurant-insert-confirm', [CustomAuthController::class, 'restaurantInsertConfirm'])->name('restaurant.insert.confirm');
Route::get('restaurant-select/{id}', [CustomAuthController::class, 'restaurantSelect'])->name('restaurant.select');
Route::get('restaurant-update/{id}', [CustomAuthController::class, 'restaurantUpdate'])->name('restaurant.update');
Route::post('restaurant-update-confirm', [CustomAuthController::class, 'restaurantUpdateConfirm'])->name('restaurant.update.confirm');

Route::get('menu-insert/{rid}', [CustomAuthController::class, 'menuInsert'])->name('menu.insert');
Route::post('menu-insert-confirm}', [CustomAuthController::class, 'menuInsertConfirm'])->name('menu.insert.confirm');
Route::get('menu-select/{id}', [CustomAuthController::class, 'menuSelect'])->name('menu.select');
Route::get('menu-update/{id}', [CustomAuthController::class, 'menuUpdate'])->name('menu.update');
Route::post('menu-update-confirm', [CustomAuthController::class, 'menuUpdateConfirm'])->name('menu.update.confirm');

Route::get('order-index', [CustomAuthController::class, 'orderIndex'])->name('order.index');
Route::get('order-insert', [CustomAuthController::class, 'orderInsert'])->name('order.insert');
Route::post('order-insert-confirm', [CustomAuthController::class, 'orderInsertConfirm'])->name('order.insert.confirm');
Route::get('order-select/{id}', [CustomAuthController::class, 'orderSelect'])->name('order.select');
Route::get('order-update/{id}', [CustomAuthController::class, 'orderUpdate'])->name('order.update');
Route::post('order-update-confirm', [CustomAuthController::class, 'orderUpdateConfirm'])->name('order.update.confirm');

Route::post('order-item-insert', [CustomAuthController::class, 'orderItemInsert'])->name('order.item.insert');
Route::post('order-item-delete', [CustomAuthController::class, 'orderItemDelete'])->name('order.item.delete');

Route::get('payment-insert/{oid}', [CustomAuthController::class, 'paymentInsert'])->name('payment.insert');
Route::post('payment-insert-confirm/{oid}', [CustomAuthController::class, 'paymentInsertConfirm'])->name('payment.insert.confirm');
