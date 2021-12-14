<?php

namespace App\Http\Middleware;

use App\Models\skill_user;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class Access_Authentication
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
        if (Auth::check()) {
            if (Auth::user()->can('basic', skill_user::class)||Auth::user()->can('intermediate', skill_user::class)||Auth::user()->can('advance', skill_user::class)) {
                return $next($request);
            }
        }

        return redirect('/login');
    }
}
