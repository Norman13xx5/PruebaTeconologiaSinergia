<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class CheckApiToken
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->hasSession()) {
            $token = $request->session()->get('api_token') ?? $request->bearerToken();

            if ($token) {
                $accessToken = PersonalAccessToken::findToken($token);

                if ($accessToken && $accessToken->tokenable) {
                    Auth::guard('web')->login($accessToken->tokenable);
                    view()->share('authenticatedUser', $accessToken->tokenable);
                }
            }
        }

        return $next($request);
    }
}
