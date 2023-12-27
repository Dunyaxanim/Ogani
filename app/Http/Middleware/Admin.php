<?php

namespace App\Http\Middleware;

use Closure;
use App\Enums\Guards;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!Auth()->user()->type== Guards::admin->name){
            return redirect()->route('home');
        }
        return $next($request);
    }
}
