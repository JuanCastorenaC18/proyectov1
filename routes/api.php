<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CodeController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/auth/codemobile', [CodeController::class, 'codeifmobile']);
Route::get('/auth/codemo', function () {
    return 'probanding';
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/********************************************************** */
Route::post('  ', function (Request $request) {
    $user = Auth::user();
    if (Google2FA::verifyKey($user->google2fa_secret, $request->input('code'))) {
        return response()->json(['success' => true]);
    }
    return response()->json(['success' => false], 401);
})->middleware(['auth']);
/********************************************************** */
