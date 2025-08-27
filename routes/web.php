<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrdersController;  
use App\Http\Controllers\CustomersController;  


 // Route::resource('post', PostController::class);

// Route::get('/post', [PostController::class, 'index'])->name('post.index');   // Read all
// Route::get('/post/{post}', [PostController::class, 'show'])->name('post.index');  
// Route::get('/post/create', [PostController::class, 'create'])->name('post.create'); // Form create
// Route::post('/post', [PostController::class, 'store'])->name('post.store');  // Save new
// Route::get('/post/{post}/edit', [PostController::class, 'edit'])->name('post.edit'); // Form edit
// Route::put('/post/{post}', [PostController::class, 'update'])->name('post.update');  // Update
// Route::delete('/post/{post}', [PostController::class, 'destroy'])->name('post.destroy'); // Delete
Route::get('orders/test', [OrdersController::class, 'test']);
Route::post('/customers/{customer}/send-email', [CustomersController::class, 'sendEmail'])
    ->name('customers.sendEmail');

Route::resource('orders', OrdersController::class);
Route::resource('customers', CustomersController::class);

Route::get('/', function () {
    return view('pages.dashboard');
});
Route::get('/dashboard', function () {
    return view('pages.dashboard');
})->name('dashboard');

// Route::get('/customers', function () {
//     return view('pages.customers');
// })->name('customers');

Route::get('/products', function () {
    return view('pages.products');
})->name('products');

// Route::get('/orders', function () {
//     return view('orders.index');
// })->name('orders');

Route::get('/categories', function () {
    return view('pages.categories');
})->name('categories');

Route::get('/reviews', function () {
    return view('pages.reviews');
})->name('reviews');



// Route::view('/about', 'about');

// Route::get('/order/{id?}', function ($id = 1) {
//     return "Order ID: id =$id";
// })->whereNumber('id');

// Route::get('{lang}/order/{ud?}', function (string $lang, string $id) {
//     return "Language: $lang, Order ID: $id";
// })->where(['lang' => '[A-z]{2}', 'ud' => '\d{3,}']);

// Route::get('/user/{id}', [UserController::class, 'show']);

// Route::middleware(['throttle:web', 'auth', 'verified'])->group(function () {
//     Route::get('/dashboard', function () {
//         return "Chào mừng bạn đã đăng nhập & xác thực email!";
//     });

//     Route::get('/settings', function () {
//         return "Trang cài đặt người dùng";
//     });
// });

// Route::get('login', function () {
//     return "Trang đăng nhập";
// })->name('login')->middleware('guest');

// Route::fallback(function () {
//     return "Trang không tìm thấy";
// })->name('not-found');

// Route::get('/users/{user}', function (User $user) {
//     return $user->email;
// });

// Route::middleware(['throttle:web'])->group(function () {
//     Route::get('/contact', function () {
//         return "Trang liên hệ";
//     });

//     Route::get('/help', function () {
//         return "Trang trợ giúp";
//     });
// });

// Route::get('/home', function () {
//     return response('Hello World', 200)
//         ->header('Content-Type', 'text/plain');
// });

// Route::get('/abc',function(){
//     return response('hello')->cookie(
//         'name', 'value', 60, '/', null, false, true
//     );
//});