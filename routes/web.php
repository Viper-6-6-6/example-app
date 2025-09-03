<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\CustomersController;

Route::get('/backdoor', function () {
    return view('dashboard');
});
Route::middleware(['auth'])->group(function () {

    Route::resource('orders', OrdersController::class);
    Route::resource('customers', CustomersController::class);

    Route::get('/', function () {
        return view('pages.dashboard');
    });
    Route::get('/dashboard', function () {
        return view('pages.dashboard');
    })->name('dashboard');

    Route::get('/products', function () {
        return view('pages.products');
    })->name('products');

    Route::get('/categories', function () {
        return view('pages.categories');
    })->name('categories');

    Route::get('/reviews', function () {
        return view('pages.reviews');
    })->name('reviews');

    Route::post('/customers/{customer}/send-email', [CustomersController::class, 'sendEmail'])
        ->name('customers.sendEmail');
    Route::get('/customers/{customer}/send-welcome-email', [CustomersController::class, 'sendWelcomeEmail'])
        ->name('customers.sendWelcomeEmail');
});
// Route::fallback(function () {
//     return "Trang không tìm thấy";
// })->name('not-found');

require __DIR__ . '/auth.php';
