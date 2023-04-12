<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Spatie\Permission\Models\Role;
use App\Models\Session;

class LocationValidationMiddleware
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

        return $next($request);
    }
}
