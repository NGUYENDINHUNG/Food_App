<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CategoryController;
use App\Livewire\Admin\CategoryManagement;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\FoodManagement;
use App\Livewire\Client\CartComponent;
use App\Livewire\Client\OrderComponent;
use App\Livewire\Client\OrderHistoryComponent;
use App\Livewire\Client\OrderSuccessComponent;
use Illuminate\Support\Facades\Route;


Route::prefix('auth')->name('auth.')->controller(AuthController::class)->group(function () {
    Route::get('/register', 'showRegisterForm')->name('register');
    Route::post('/register', 'register')->name('register.store');
    Route::get('/login', 'showLogin')->name('login');
    Route::post('/login', 'login')->name('login.store');
    Route::post('/logout', 'logout')->name('logout');
});


//client
Route::prefix('/')->group(function () {
    Route::get('/', fn() => view('client.home.home'))->name('home');
    Route::get('/categories', [CategoryController::class, 'clientIndex'])->name('categories.index');
    Route::get('/categories/{category}', [CategoryController::class, 'clientShow'])->name('categories.show');


    Route::middleware('auth')->group(function () {
        Route::get('/cart', CartComponent::class)->name('cart.index');
        Route::get('/checkout', OrderComponent::class)->name('orders.index');
        Route::get('/myorder', OrderHistoryComponent::class)->name('ordersHistory.index');
        Route::get('/order-success/{orderId?}', OrderSuccessComponent::class)->name('order.success');
    });
});


//admin
Route::prefix('admin')->middleware('admin')->name('admin.')->group(function () {
    Route::get('/', Dashboard::class)->name('dashboard');
    Route::get('/categories', CategoryManagement::class)->name('categories');
    Route::get('/foods', FoodManagement::class)->name('foods');
});
