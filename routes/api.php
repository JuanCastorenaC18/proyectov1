<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CodeController;
use App\Events\QrStatusChangedEvent;

use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Session;
use App\Events\TupuEvent;
use Pusher\Pusher;



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

Route::post('/verifyQR', function (Request $request) {

    $data = [
        'token' => $request->code_mobile,
        'rol' => $request->code_mobile,
    ];

    event(new QrStatusChangedEvent($data));

    return response()->json(['Succes' => true], 200);
});
