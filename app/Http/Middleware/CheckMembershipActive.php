<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckMembershipActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        // If not logged in or not a member, let them through
        if (!$user || !$user->isMember()) {
            return $next($request);
        }

        // If membership is expired, block access to premium features
        if ($user->isMembershipExpired()) {
            // For AJAX requests expecting JSON
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Membership Anda telah expired. Silakan perpanjang untuk mengakses fitur ini.',
                    'expired' => true,
                    'redirect_url' => route('member.payment.create'),
                ], 403);
            }

            // For regular requests, redirect to dashboard with flash message
            return redirect()
                ->route('member.dashboard')
                ->with('membership_expired', true)
                ->with('error', 'Membership Anda telah expired. Silakan perpanjang untuk mengakses Workout Plans.');
        }

        return $next($request);
    }
}
