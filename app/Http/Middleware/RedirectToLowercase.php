<?php

namespace App\Http\Middleware;

use Closure;
use Request;
class RedirectToLowercase
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $path = Request::getRequestUri();
        $pathLowercase = strtolower($path);
        // dd($path);
        if ($path !== $pathLowercase) {
            // redirect if lowercased path differs from original path
            return redirect($pathLowercase,301);
          }
        return $next($request);
    }
}
