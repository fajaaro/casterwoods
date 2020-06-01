<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Http\Request;

class CheckAdmin
{
    public function handle(Request $request, Closure $next)
    {
        $user = User::where('api_token', $request->bearerToken())->first();
        
        if ($user->is_admin) {
            return $next($request);
        }

        return response()->json([
            'message' => 'Unauthenticated.',
        ], 401);
    }
}
