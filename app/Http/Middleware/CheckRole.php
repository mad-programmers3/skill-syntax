<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->user() && $request->user()->role_id === 4) {
            return redirect('/')->with('error', 'You do not have admin access');
        }

        return $next($request);
    }
}
