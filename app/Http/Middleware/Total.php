<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Basket;
use Illuminate\Support\Facades\Auth;
class Total
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // $userId = Auth::user()->id;
        // $total = Basket::where("user_id", $userId)->sum('total');
        // if($total==0){
        //     return redirect()->back();
        // }
        return $next($request);
    }
}
