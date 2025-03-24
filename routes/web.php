<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\AuthManager;
use App\Http\Controllers\User\InvoiceManager;
use App\Http\Controllers\User\CustomerManager;
use App\Http\Controllers\User\ProductManager;
use App\Http\Controllers\User\Dashboard;
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
Route::get('/',function(){
    return redirect()->route('loginPage');
});

Route::middleware('guest')->controller(AuthManager::class)->group(function () {
    Route::get('/login', 'login')->name('loginPage');
    Route::post('/login', 'loginSubmit')->name('loginSubmit');
    Route::get('/register', 'register');
    Route::post('/register', 'regSubmit')->name('register');
});
Route::middleware('auth')->group(function () {
   Route::get('/dashboard', [Dashboard::class,'index'])->name('dashboard');
    Route::get('/logout', [AuthManager::class,'logout'])->name('logout');

    Route::name('invoice.')->controller(InvoiceManager::class)->prefix('invoices')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/{invoice}', 'show')->name('show');
        Route::get('/{invoice}/edit', 'edit')->name('edit');
      
    });
    Route::name('customer.')->controller(CustomerManager::class)->prefix('customers')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/{customer}', 'show')->name('show');
        Route::get('/{customer}/edit', 'edit')->name('edit');
    });
    Route::name('product.')->controller(ProductManager::class)->prefix('products')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
       // Route::get('/{product}', 'show')->name('show');
      //  Route::get('/{product}/edit', 'edit')->name('edit');
    });
});
