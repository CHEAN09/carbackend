<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class OwnerMiddleware
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
        $cars = $request->route('cars');

        if($cars==null){
            return response()->json(['message'=>'The car cannot be found'], 404);
        }

        if($cars->user_id != auth()->user()->id) {
            return response()->json([
                'message'=>'You are not the owner of this car'], 401 
            );
        }
        return $next($request);
    }
}
