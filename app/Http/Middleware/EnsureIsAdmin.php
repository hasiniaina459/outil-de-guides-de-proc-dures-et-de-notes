<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        /** @var \App\Models\individu $user*/
        $user=auth('individu')->user();
        if (!$user->estAdmin()){
            abort(403,'Accés réservé aux administrateurs .');
        }
        return $next($request);
    }
}
