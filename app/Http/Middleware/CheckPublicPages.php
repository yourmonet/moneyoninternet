<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPublicPages
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (app_setting('public_pages_enabled', '1') == '0') {
            $redirectUrl = app_setting('public_pages_redirect_url');
            if (!empty($redirectUrl)) {
                return redirect()->to($redirectUrl);
            }
            abort(404);
        }

        return $next($request);
    }
}
