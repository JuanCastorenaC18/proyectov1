<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrCodeController extends Controller
{
    public function show(Request $request)
    {
        $qrCode = QrCode::size(250)->generate($request->session()->getId());
        return view('qr-code', compact('qrCode'));
    }

    public function check(Request $request)
    {
        $sessionId = $request->input('session_id');

        if ($request->session()->getId() === $sessionId) {
            $request->session()->regenerate();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }
}
