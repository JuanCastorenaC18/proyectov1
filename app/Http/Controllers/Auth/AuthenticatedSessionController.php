<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Mail\TestCodeMail;
use Illuminate\Support\Facades\Log;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cookie;
use App\Models\Qrs;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Response;
use App\Http\Controllers\console;
use Spatie\Permission\Models\Permission;


class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /*public function store(LoginRequest $request)
    {
        
        $request->authenticate();
        $request->session()->regenerate();
        
        // $value = $request->session()->get('key', 'default');
        //$nombres = "";// inicializa el arreglo de nombres vacío
        // $value = $request->session()->get('key', 'default');
        $nombres = [];// inicializa el arreglo de nombres vacío
        /*
        foreach (auth()->user()->roles as $role) {
            $nombres = $role->name; // agrega el nombre del usuario al arreglo de nombres
        }
        
        foreach (auth()->user()->roles as $role) {
            $nombres[] = $role->name; // agrega el nombre del usuario al arreglo de nombres
        }
  
        if (in_array('normal', $nombres)) {
            Auth::logout();
            return redirect()->route('admin.login')->withErrors([
                    'message' => __('No puedes iniciar sesión en esta aplicación.'),
            ]);
        }
        //return $nombres; // devuelve el arreglo de nombres
        else if(in_array('supervisor', $nombres)){
        //SUPERVISOR 
            //Mail::to($request->email)->send(new EmailSend());
            return view('verificacion');
        }  
        else if (in_array('admin', $nombres)){
            Mail::to($request->email)->send(new EmailSend());
            return view('verificacionadmin');
            //ADMINISTRADOR
        } 
    }*/

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $logeado = Auth::user();
        if ($logeado->hasRole('Admin')) {
            Auth::guard('web')->logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();
            return redirect('/');
        } 
        elseif ($logeado->hasRole('Supervisor')) {
            $logeado->revokePermissionTo(['products.destroy', 'supervisors.destroy', 'categories.destroy', 'users.destroy']);
            Auth::guard('web')->logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();
            return redirect('/');
        } else {
            $logeado->revokePermissionTo(['products.edit', 'products.update', 'categories.edit', 'categories.update']);
            Auth::guard('web')->logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();
            return redirect('/');
        }
        
        
    }
    /*/public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();
        
       // $value = $request->session()->get('key', 'default');
         $rolname = "";// inicializa el arreglo de nombres vacío

        foreach (auth()->user()->roles as $role) {
            $rolname = $role->name; // agrega el nombre del usuario al arreglo de nombres
        }
   
    //return $nombres; // devuelve el arreglo de nombres
        if ($rolname == "Supervisor") {
            //SUPERVISOR 
            //Mail::to($request->email)->send(new TestCodeMail());
            return redirect()->route('auth_entercode');
            //return view('enter-code');
        } else{
            //ADMINISTRADOR
            if($rolname == "Admin")
            {
                //SE GENERA EL CODE
                //Mail::to($request->email)->send(new TestCodeMail());
                return redirect()->route('auth_qrcode');
            }
            else {
                //CUALQUIER USUARIO SIN ROL O CON ROL DESCONOCIDO
                return redirect()->intended(RouteServiceProvider::HOME); 
            }
        }
        //return redirect()->intended(RouteServiceProvider::ADMIN_HOME);
    }*/
}
