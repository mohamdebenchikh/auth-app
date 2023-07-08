<?php

namespace App\Middleware;

use App\Core\Auth;

class GuestMiddleware
{
    public function handle($request,$next)
    {
        if(!Auth::check()){
            return $next($request);
        }

        return redirect()->to(url('/home'));
    }
}
