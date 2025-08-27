<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Redirect;

class verified
{
    public function handle(Request $request, Closure $next)
    {
        if (! $request->user() || ! $request->user()->hasVerifiedEmail()) {
            return $request->expectsJson()
                        ? abort(403, 'Your email address is not verified.')
                        : Redirect::route('verification.notice');
        }

        return $next($request);
    }
}
