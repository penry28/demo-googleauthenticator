<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TwoFaceVerify
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $secretCode = auth()->user()->secret_code;
        if ($secretCode && session("2fa_verified") == 'verified') {
            return redirect()->route("2fa.verifyForm");
        }
        return $next($request);
    }
}
