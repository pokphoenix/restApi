<?php

namespace App\Http\Middleware;

use Closure;
use DB;
use Session;
use VG;
use Auth;

class ApiAuth
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
        try{
            $user = \Tymon\JWTAuth\Facades\JWTAuth::parseToken()->toUser();
            if(! $user){
                return "error: User not found" ;
            }
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $ex){
            return "error: User not found" ;
        }

        return compact('user');

        return $next($request);
    }
}
