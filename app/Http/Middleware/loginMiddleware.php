<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use App\City;
use App\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class loginMiddleware {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
   public function handle($request, Closure $next) {
    //    $cities = City::with('country')->get();
    if(!Auth::check()){
        return redirect()->route('home');
    }       
    return $next($request);
   }

}
