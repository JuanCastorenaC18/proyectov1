<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CodeController;
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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
