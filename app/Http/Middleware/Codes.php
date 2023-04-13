<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Codes
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $location = \config('getLocation.location');

        $user =$request->user();

        $role = $user->getRoleNames()->first();

        if ($role == 'Admin' && $location == 'public') {
            $request->session()->invalidate();
           return redirect('/');
        }

        if($role == 'Client' && $location == 'vpn'){
            $request->session()->invalidate();
            return redirect('/');
        }

        if($role == 'Client' && $location == 'public'){
            return $next($request);
        }

        if ($request->session()->has('code')) {return $next($request);}

        return redirect()->route('auth_entercode');
    }
}
