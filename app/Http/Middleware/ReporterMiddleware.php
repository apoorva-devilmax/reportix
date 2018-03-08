<?php

namespace App\Http\Middleware;

use Closure;
use App\Role;

class ReporterMiddleware
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
        if(!$request->user()->hasRole([Role::REPORTER, Role::ADMIN])){
            return redirect('home');
        }
        return $next($request);
    }
}
