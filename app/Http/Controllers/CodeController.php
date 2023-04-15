<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Mail\TestCodeMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Codes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class CodeController extends Controller
{
    public function sendsignedroute(Request $request)
    {
        $codigoweb = random_int(10000, 99999);
        $codigomobile = random_int(10000, 99999);
        $verificadcode = Codes::where('user_id', Auth::user()->id)->where('status',true)->get();
        if(count ($verificadcode) == 0){
            $in_data = new Codes();
            $in_data->user_id = Auth::user()->id;
            $in_data->code_one = Hash::make($codigoweb); $in_data->code_two = Hash::make($codigomobile);
            $in_data->code_one_comparison = Crypt::encryptString($codigoweb); $in_data->code_two_comparison = Crypt::encryptString($codigomobile);
            $in_data->save();

            $signed_Route = URL::temporarySignedRoute('code_see', now()->addMinutes(10), Auth::user()->id);
            $mail= new TestCodeMail($signed_Route);
            Mail::to(Auth::user()->email)->send($mail);
        } return view('enter-code');
    }

    public function seecodemobile(Request $request)
    {
        try {
            $code = Codes::where('user_id', Auth::user()->id)->where('status',true)->first();
            return view('see-code',['code'=>Crypt::decryptString($code->code_two_comparison)]);
        } catch (Throwable $th) {return response()->json(['message'=> "Bad Request"], 400); }
    }

    public function codeifweb(Request $request)
    {
        $code_one = $request->input('code_one');
        $code_extraid = Codes::where('user_id', Auth::user()->id)->where('status',true)->get();

        foreach ($code_extraid as $runner) {
            if(Hash::check($code_one, $runner->code_one)){
                $code_affirming = Codes::find($runner->id);
                $code_affirming->status = false;
                $code_affirming->save();

                if(Auth::user()->getRoleNames()->first() == "Admin"){
                    return redirect('qrcode');
                }

                Session::put('code', $runner->code_one);
                return redirect('dashboard');
            }
        } return view('enter-code');
    }

    public function codeifmobile(Request $request)
    {
        $code_mobile = $request->input('code_mobile');
        $code_extraid = Codes::where('status', true)->get();
        //$loginCode = Codes::where('code_mobile', $code_mobile)->first();
        //$user = $loginCode->user_id;
        //return $user;
        foreach ($code_extraid as $runner) {
            if(Hash::check($code_mobile, $runner->code_two)){

                return response()->json(['code_one'=> Crypt::decryptString($runner->code_one_comparison)], 200);
            }
        } return response()->json(['message'=> "Codigo Expiarado"], 400);
    }

    public function rol(Request $request){
        $userinlogin = Auth::user();

        /*if ($user->hasRole('Admin')) {
            $rolname = 'Admin';
            $data = [
                'user' => $user,
                'ROLNAME' => $rolname,
            ];
            return response()->json($data, 200);
        }
        elseif ($user->hasRole('Supervisor')) {
            $rolname = 'Supervisor';
            $data = [
                'user' => $user,
                'ROLNAME' => $rolname,
            ];
            return response()->json($data, 200);
        } else {
            $rolname = 'Client';
            $data = [
                'user' => $user,
                'ROLNAME' => $rolname,
            ];

            return response()->json($data, 200);
        }*/
    }
}
