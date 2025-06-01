<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SessionTimeout
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $timeout = config('session.timeout', 30); // 30 minutes default
            $lastActivity = Session::get('last_activity', time());

            if (time() - $lastActivity > ($timeout * 60)) {
                Auth::logout();
                Session::flush();
                Session::regenerate();

                if ($request->expectsJson()) {
                    return response()->json(['message' => 'Session expired'], 401);
                }

                return redirect('/login')->with('warning', 'Your session has expired due to inactivity.');
            }

            // Update last activity timestamp
            Session::put('last_activity', time());
        }

        return $next($request);
    }
}