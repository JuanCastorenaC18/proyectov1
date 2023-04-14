<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Session;

class QrCodeController extends Controller
{
    public function show(Request $request)
    {
        $qrCode = QrCode::size(250)->generate($request->session()->getId());
        return view('qr-code', compact('qrCode'));
    }

    public function check(Request $request)
    {
        $request->session()->getId();
        /*$sessionId = $request->input('session_id');

        if ($request->session()->getId() === $sessionId) {
            $request->session()->regenerate();

            Session::put('code', '123');
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);*/
        $function = FunctionModel::where('qr_code', $code)->first();
    }
}
