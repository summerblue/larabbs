<?php

namespace App\Http\Middleware;

use Closure;

class AcceptHeader
{
<<<<<<< HEAD
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $request->headers->set('Accept','application/json');
=======
    public function handle($request, Closure $next)
    {
        $request->headers->set('Accept', 'application/json');
>>>>>>> f2c8031f97e0ba5e7b887e71a847a0cc605b6531

        return $next($request);
    }
}
