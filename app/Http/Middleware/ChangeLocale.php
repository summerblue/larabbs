<?php

namespace App\Http\Middleware;

use Closure;

class ChangeLocale
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
        $language = $request->header('accept-language');
        if($language){
=======
    public function handle($request, Closure $next)
    {
        $language = $request->header('accept-language');
        if ($language) {
>>>>>>> f2c8031f97e0ba5e7b887e71a847a0cc605b6531
            \App::setLocale($language);
        }

        return $next($request);
    }
}
