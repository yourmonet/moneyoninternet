<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureOnboardingCompleted
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $hasCompleted = $request->cookie('onboarding_completed');

        // Jika mengakses halaman onboarding tapi sudah pernah menyelesaikannya
        if ($request->is('onboarding*') && $hasCompleted) {
            return redirect()->route('login');
        }

        // Jika mengakses halaman login tapi belum pernah menyelesaikan onboarding
        if (!$hasCompleted && !$request->is('onboarding*')) {
            return redirect()->route('onboarding');
        }

        return $next($request);
    }
}
