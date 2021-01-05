<?php

namespace App\Http\Middleware;


use Auth;
use Closure;
use Illuminate\Support\Arr;
use App\User;

class CheckPermissions
{
    public function handle($request, Closure $next)
    {
        $permission = User::USER_PERMISSION[Auth::user()->type];
        $path = explode('/',$request->path());
        if((is_numeric(array_search($path[0], $permission)) || Auth::user()->type  == User::SUPER_ADMIN)) {
            return $next($request);
        } else {
            return back();
        }
        return $next($request);
    }
}
