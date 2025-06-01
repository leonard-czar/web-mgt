<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class SessionWarning
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $timeout = config('session.timeout', 30) * 60; // Convert to seconds
            $lastActivity = Session::get('last_activity', time());
            $timeRemaining = $timeout - (time() - $lastActivity);
            $warningTime = config('session.warning_time', 5) * 60; // 5 minutes warning

            // Share session data with all views
            View::share([
                'sessionTimeout' => $timeout,
                'timeRemaining' => max(0, $timeRemaining),
                'showWarning' => $timeRemaining <= $warningTime && $timeRemaining > 0
            ]);
        }

        return $next($request);
    }
}
