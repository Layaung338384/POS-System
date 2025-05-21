<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
// {
//     /**
//      * Handle an incoming request.
//      *
//      * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
//      */
//     public function handle(Request $request, Closure $next): Response
//     {

//         //not login -> login || register -> open
//         //login -> login || register -> close


//         if(Auth::user()){

//             if(Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin'){

//                 //when user call login and register -> kill url and error if call other url it is success
//                 if($request->route()->getName() == 'login' || $request->route()->getName() == 'register'){
//                     abort(404);
//                 }
//                 //user can login and register expects login and register
//                 return $next($request);
//             }

//             return back();

//         }else{
//             //when user not login -> can call login and register
//             return $next($request);
//         }
//     }
// }
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // If user is not logged in
        if (!$user) {
            return redirect()->route('login')->withErrors('You must be logged in.');
        }

        // If user is not admin or superadmin
        if (!in_array($user->role, ['admin', 'superadmin'])) {
            abort(403, 'Access denied.');
        }

        // Optional: Block admin from accessing login/register routes
        if (in_array($request->route()->getName(), ['login', 'register'])) {
            abort(404);
        }

        return $next($request);
    }
}
