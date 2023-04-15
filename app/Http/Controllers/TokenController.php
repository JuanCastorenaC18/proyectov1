<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Mail\Mailtokencliente;
use App\Mail\Mailtokensupervisor;
use Illuminate\Support\Facades\Mail;
use App\Models\Tokens;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class TokenController extends Controller
{
    public function sendToken(Request $request)
    {
        $location = \config('getLocation.location');


        if ($location == "vpn"){
            $tokenweb = random_int(1000000, 9999999);
            $email = $request->input('email');
            $user = \App\Models\User::where('email', $email)->first();
            $id_del_usuario = $user->id;
            $verificadtoken = Tokens::where('user_id', $id_del_usuario)->where('status',true)->get();
            if(count ($verificadtoken) == 0){
                $in_data = new Tokens();
                $in_data->user_id = $id_del_usuario;
                $in_data->token_one = Hash::make($tokenweb);
                $in_data->token_one_comparison = Crypt::encryptString($tokenweb);
                $in_data->save();

                $signed_Route = URL::temporarySignedRoute('seeToken', now()->addMinutes(10), $id_del_usuario);
                $mail= new Mailtokencliente($signed_Route);
                Mail::to($email)->send($mail);
                return redirect()->back()->with('Exito', 'Correo enviado correctamente');
            } else{
                return redirect()->back()->with('Error', 'El supervisor tiene un token activo');
            }
        } else {
            return redirect()->back()->with('Error', 'Solo se puede generar token de permiso por VPN');
        }
    }

    public function seeToken(Request $request)
    {
        try {
            $token = Tokens::where('user_id', Auth::user()->id)->where('status',true)->first();
            $verificadtoken = Tokens::where('user_id', Auth::user()->id)->where('status',true)->get();
            if(count ($verificadtoken) == 1){
                return view('see-tokenadmin',['token'=>Crypt::decryptString($token->token_one_comparison)]);
            }
            else{
                return 'wey no tienes token activo';
            }
        } catch (Throwable $th) {
            return response()->json(['message'=> "Bad Request"], 400);
        }
    }

    public function validacionToken(Request $request)
    {
        $token_one = $request->input('token_one');
        $code_extraid = Tokens::where('user_id', Auth::user()->id)->where('status',true)->get();
        foreach ($code_extraid as $runner) {
            if(Hash::check($token_one, $runner->token_one)){
                $code_affirming = Tokens::find($runner->id);
                $code_affirming->status = false;
                $code_affirming->save();
                $logeado = Auth::user();
                $logeado->givePermissionTo(['products.edit', 'products.update', 'categories.edit', 'categories.update']);
                Session::put('token', $runner->token_one);
                return redirect()->route('products.index')->with('Exito', 'Ya tienes los permisos para modificar');
            }
        }
        //return view('customers.customer')->with();
    }

    public function sendTokenAdmin(Request $request)
    {
        $tokenweb = random_int(1000000, 9999999);
        $email = $request->input('email');
        $user = \App\Models\User::where('email', $email)->first();
        $id_del_usuario = $user->id;
        $verificadtoken = Tokens::where('user_id', $id_del_usuario)->where('status',true)->get();
        if(count ($verificadtoken) == 0){
            $in_data = new Tokens();
            $in_data->user_id = $id_del_usuario;
            $in_data->token_one = Hash::make($tokenweb);
            $in_data->token_one_comparison = Crypt::encryptString($tokenweb);
            $in_data->save();

            $signed_Route = URL::temporarySignedRoute('seeTokenAdmin', now()->addMinutes(10), $id_del_usuario);
            $mail= new Mailtokensupervisor($signed_Route);
            Mail::to($email)->send($mail);
            return redirect()->back()->with('Exito', 'Correo enviado correctamente');
        } else {
            return redirect()->back()->with('Error', 'El supervisor tiene un token activo');
        }
    }

    public function seeTokenAdmin(Request $request)
    {
        try {
            $token = Tokens::where('user_id', Auth::user()->id)->where('status',true)->first();
            $verificadtoken = Tokens::where('user_id', Auth::user()->id)->where('status',true)->get();
            if(count ($verificadtoken) == 1){
                return view('see-tokenadmin',['token'=>Crypt::decryptString($token->token_one_comparison)]);
            }
            else{
                return 'wey no tienes token activo';
            }
        } catch (Throwable $th) {
            return response()->json(['message'=> "Bad Request"], 400);
        }
    }

    public function validacionTokenAdmin(Request $request)
    {
        $token_one = $request->input('token_one');
        $code_extraid = Tokens::where('user_id', Auth::user()->id)->where('status',true)->get();
        foreach ($code_extraid as $runner) {
            if(Hash::check($token_one, $runner->token_one)){
                $code_affirming = Tokens::find($runner->id);
                $code_affirming->status = false;
                $code_affirming->save();
                $logeado = Auth::user();
                $logeado->givePermissionTo(['products.destroy', 'supervisors.destroy', 'categories.destroy', 'users.destroy']);
                Session::put('token', $runner->token_one);
                return redirect()->route('users.index')->with('Exito', 'Ya tienes los permisos para desactivar');
            }
        } return redirect()->back()->with('Error', 'El token no es valido');
    }
}
