<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = Auth::user();

        if ($user) {
            foreach ($roles as $role) {
                if ($user->Roles == $role) {
                    return $next($request);
                }
            }
        }


        abort(403, 'Unauthorized action.');
    }
}
