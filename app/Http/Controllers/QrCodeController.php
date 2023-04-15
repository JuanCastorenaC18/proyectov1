<?php

namespace App\Http\Controllers;

    use Illuminate\Support\Facades\Auth;
    use Illuminate\Http\Request;
    use SimpleSoftwareIO\QrCode\Facades\QrCode;
    use Illuminate\Support\Facades\Session;
    use App\Events\QrStatusChangedEvent;
    use App\Events\TupuEvent;
    use Pusher\Pusher;


class QrCodeController extends Controller
{
    public function show(Request $request)
    {
        $qrCode = QrCode::size(250)->generate($request->session()->getId());

        $token = $request->session()->getId();
        $logeado = Auth::user();
        if ($logeado->hasRole('Admin')) {
            $rol ='Admin';
        }
        elseif ($logeado->hasRole('Supervisor')) {
            $rol ='Supervisor';
        }
        else{
            $rol ='Client';
        }

        $email = Auth::user()->email;

        $data = [
            'token' => $token,
            'rol' => $rol,
            'email' => $email,
        ];

        event(new QrStatusChangedEvent($data));

        return view('qr-code', compact('qrCode', 'email', 'token', 'rol'));
    }

    public function check(Request $request)
    {

        $token = $request->token;
        $rol = $request->rol;
        $email = $request->email;

        if($email == Auth::user()->email && $rol == "Admin"){
            Session::put('codeQR', 'true');
            return redirect('dashboard');
        }

        $qrCode = QrCode::size(250)->generate($request->session()->getId());

        return view('qr-code', compact('qrCode', 'email', 'token', 'rol'));
    }
}
