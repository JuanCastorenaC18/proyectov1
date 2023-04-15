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
        //broadcast(new QrStatusChangedEvent($user, $qr));
        $hora = 'hora';

        $data = [
            'token' => $token,
            'rol' => $rol,
        ];
        $mensaje = [
            'mensaje' =>'Hola soy el server',
        ];

        event(new QrStatusChangedEvent($data));
        // event(new TupuEvent($mensaje));

        // Mostrar la vista
        return view('qr-code', compact('qrCode'));
        //return view('example.index');
    }

    public function check(Request $request)
    {
        // $request->session()->getId();

        Session::put('codeQR', 'true');


        

        // $user = Auth::user()->email;


        /*$sessionId = $request->input('session_id');

        if ($request->session()->getId() === $sessionId) {
            $request->session()->regenerate();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);*/
        // $function = FunctionModel::where('qr_code', $code)->first();

        return redirect('dashboard');
    }
}
