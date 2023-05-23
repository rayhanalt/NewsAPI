<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAccessToken
{
    public function handle($request, Closure $next)
    {
        try {
            $user = Auth::guard('api')->user();
            if (!$user) {
                return response()->json(['message' => 'Anda harus login'], 401);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Anda harus login'], 401);
        }

        return $next($request);
    }
}
