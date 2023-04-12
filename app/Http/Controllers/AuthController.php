<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class AuthController extends Controller
{
    public function authenticate(Request $request)
    {
        // Genera el token de autenticación
        $token = Auth::guard('sanctum')->issue();

        // Crea la URL del escáner de QR
        $url = URL::temporarySignedRoute(
            'auth.scan',
            now()->addMinutes(5),
            ['token' => $token]
        );

        // Genera el código QR de la URL
        $qr = QrCode::size(200)->generate($url);

        // Retorna la vista con el código QR
        return view('auth.qr', compact('qr'));
    }
}
