<?php

namespace App\Http\Middleware;

use Closure;

class CheckHeaders
{
    public function handle($request, Closure $next)
    {
        $restrictedKey = $request->header('Restricted');

        if ($restrictedKey == 'Evertise2020') {
            return $next($request);
        }

        return response()->json([
            'message' => 'Unauthenticated.',
        ], 401);
    }
}
