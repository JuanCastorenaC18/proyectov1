<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Session;
use App\Events\QrStatusChangedEvent;
use Pusher\Pusher;

class QrCodeController extends Controller
{
    public function show(Request $request)
    {
        $qrCode = QrCode::size(250)->generate($request->session()->getId());

        $token = $request->session()->getId();
            $logeado = Auth::user();
            if ($logeado->hasRole('Admin')) {
                $rol ='Administrador';
            }
            elseif ($logeado->hasRole('Supervisor')) {
                $rol ='Supervisor';
            }
            else{
                $rol ='Client';
            }
        //broadcast(new QrStatusChangedEvent($user, $qr));
        event(new QrStatusChangedEvent($rol, $token));

        // Mostrar la vista
        return view('qr-code', compact('qrCode'));
        //return view('example.index');
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
