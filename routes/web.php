<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CodeController;
use App\Http\Controllers\GivePermissionController;
use App\Http\Controllers\TokenController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\QrCodeController;
use Illuminate\Support\Facades\Route;
/******************************************************* */
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\Png;
use BaconQrCode\Writer;
use Google\Authenticator\Google2FA;
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
/*--------------------------------------------------------------------------*/
Route::get('/seeToken', [TokenController::class, 'seeToken'])->name('seeToken');
Route::post('/sendToken', [TokenController::class, 'sendToken'])->name('sendToken');
Route::post('/validacionToken', [TokenController::class, 'validacionToken'])->name('validacionToken');
/*--------------------------------------------------------------------------*/
/*--------------------------------------------------------------------------*/
Route::get('/seeTokenAdmin', [TokenController::class, 'seeTokenAdmin'])->name('seeTokenAdmin');
Route::post('/sendTokenAdmin', [TokenController::class, 'sendTokenAdmin'])->name('sendTokenAdmin');
Route::post('/validacionTokenAdmin', [TokenController::class, 'validacionTokenAdmin'])->name('validacionTokenAdmin');
/*--------------------------------------------------------------------------*/
Route::resource('supervisors', GivePermissionController::class)->names(['supervisors']);
Route::get('/customers', [GivePermissionController::class, 'indexcustom'])->name('supervisors.indexcustom');
/*--------------------------------------------------------------------------*/
Route::resource('admins', AdminController::class)->names(['admins']);
/*Route::get('/supervisor', function () {
    return view('supervisor.supervisor');
})->middleware(['auth'])->name('supervisor');*/

/*--------------------------------------------------------------------------*/
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified','codes'])->name('dashboard');

Route::get('/prueba', function () {
    return view('prueba');
})->middleware(['auth', 'verified','codes'])->middleware('can:prueba')->name('prueba');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
/*-------------------------------------------------------------------------*/
Route::resource('products', ProductController::class)->names(['products'])->middleware(['auth']);
Route::get('/products/active', [CodeController::class, 'products.active'])->name('products.active');
//Route::get('/products/codeper/{user}', [CodeController::class, 'products.active'])->name('products.codeper');
/*Route::get('/products/codeper', function () {
    return view('products.codeper');
})->name('products.codeper');*/
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
Route::get('editpermiso/{user}', [UserController::class, 'editpermiso'])->name('users.editpermiso');
Route::patch('/updatepermisos', [UserController::class, 'updatepermisos'])->name('users.updatepermisos');

/*-------------------------------------------------------------------------*/
Route::get('/customers/enviarPeticion', [ProductController::class, 'enviarPeticion'])->name('enviarPeticion');
Route::get('/customers/enviarPeticionAdmin', [ProductController::class, 'enviarPeticionAdmin'])->name('enviarPeticionAdmin');
//Route::get('/supervisors/PeticionAdmin', [GivePermissionController::class, 'PeticionAdmin'])->name('supervisors.PeticionAdmin');

require __DIR__.'/auth.php';

/*********************************************************** */
Route::get('/qrauth', function () {
    $user = Auth::user();
    $secret = Google2FA::generateSecretKey();
    $user->google2fa_secret = $secret;
    $user->save();

    $qrCode = new Writer(new ImageRenderer(new Png()));
    $image = $qrCode->writeString(
        Google2FA::getQRCodeUrl(
            config('app.name'),
            $user->email,
            $secret
        ),
        4,
        4
    );

    return view('qrauth', ['image' => base64_encode($image)]);
})->middleware(['auth']);
/*********************************************************** */

Route::post('/websocket/auth', function (Illuminate\Http\Request $request) {
    $pusher = new Pusher\Pusher(
        env('PUSHER_APP_KEY'),
        env('PUSHER_APP_SECRET'),
        env('PUSHER_APP_ID'),
        [
            'cluster' => env('PUSHER_APP_CLUSTER'),
            'useTLS' => true,
        ]
    );

    $socket_id = $request->input('socket_id');
    $channel_name = $request->input('channel_name');

    $auth = $pusher->socket_auth($channel_name, $socket_id);

    return response($auth);
})->middleware('auth');
/*********************************************************** */
Route::get('/qrcode', [QrCodeController::class, 'show'])->name('auth_qrcode');

Route::post('/qrcode/check', [QrCodeController::class, 'check']);
/*********************************************************** */

