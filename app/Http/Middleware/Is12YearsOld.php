<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Is12YearsOld
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

//        var_dump($user);

//        if($user && $user->age >= 12){
            return $next($request);
//        } else{
//            abort(403);
//        }

    }
}
