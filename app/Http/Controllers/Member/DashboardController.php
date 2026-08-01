<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Cache latest progress for 5 minutes
        $latestProgress = Cache::remember("user.{$user->id}.latest_progress", 300, function () use ($user) {
            return $user->getLatestProgress();
        });
        
        // Cache pending transaction for 5 minutes
        $pendingTransaction = Cache::remember("user.{$user->id}.pending_transaction", 300, function () use ($user) {
            return $user->transactions()
                ->where('status', 'pending')
                ->latest()
                ->first();
        });

        return view('member.dashboard', compact('user', 'latestProgress', 'pendingTransaction'));
    }
}
