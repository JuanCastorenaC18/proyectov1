<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CodeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
/*--------------------------------------------------------------------------*/
Route::get('/auth/codesee', [CodeController::class, 'seecodemobile'])->middleware('signed')->name('code_see');
Route::get('/auth/codeenter', [CodeController::class, 'sendsignedroute'])->name('auth_entercode');
Route::post('/auth/codeweb', [CodeController::class, 'codeifweb'])->name('code_web');
/*--------------------------------------------------------------------------*/
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified','codes'])->name('dashboard');

Route::get('/prueba', function () {
    return view('prueba');
})->middleware(['auth', 'verified','codes'])->name('prueba');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
/*-------------------------------------------------------------------------*/
Route::resource('products', ProductController::class)->names(['products']);
Route::get('/products/active', [CodeController::class, 'products.active'])->name('products.active');
Route::get('/productsview', function () {
    return view('products.layout');
})->middleware(['auth', 'verified','codes'])->name('productsview');

Route::get('/productsview2', function () {
    return redirect()->route('productsview');
})->middleware(['auth', 'verified','codes'])->name('productsview2');
/*-------------------------------------------------------------------------*/

/*-------------------------------------------------------------------------*/
Route::resource('categories', CategoryController::class)->names(['categories']);

Route::get('/categoriesview', function () {
    return view('categories.layout');
})->middleware(['auth', 'verified','codes'])->name('categoriesview');

Route::get('/categoriesview2', function () {
    return redirect()->route('categoriesview');
})->middleware(['auth', 'verified','codes'])->name('categoriesview2');
/*-------------------------------------------------------------------------*/

Route::get('/test-session', function () {
    session(['test_key' => 'test_value']);
    return 'Session value set';
});

Route::get('/get-session', function () {
    return session('test_key');
});

/*-------------------------------------------------------------------------*/
Route::resource('users', UserController::class)->names(['users']);

/*-------------------------------------------------------------------------*/


require __DIR__.'/auth.php';
