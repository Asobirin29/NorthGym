<?php

use App\Http\Controllers\Member\DashboardController;
use App\Http\Controllers\Member\PaymentController;
use App\Http\Controllers\Member\ProgressController;
use App\Http\Controllers\Member\WorkoutPlanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Auth routes (we'll use Laravel Breeze)
Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');

    Route::get('/login/admin', function () {
        return view('auth.admin-login');
    })->name('login.admin');

    Route::post('/login', function () {

        $credentials = request()->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        \Illuminate\Support\Facades\Log::info('Login attempt for: ' . $credentials['email']);

        if (auth()->attempt($credentials, request()->boolean('remember'))) {
            \Illuminate\Support\Facades\Log::info('Login success for: ' . $credentials['email']);
            request()->session()->regenerate();
            
            if (auth()->user()->isAdmin()) {
                return redirect('/admin');
            }
            
            return redirect()->route('member.dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    });

    Route::post('/login/admin', function () {
        $credentials = request()->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        \Illuminate\Support\Facades\Log::info('Admin login attempt for: ' . $credentials['email']);

        if (auth()->attempt($credentials, request()->boolean('remember'))) {
            if (!auth()->user()->isAdmin()) {
                auth()->logout();
                return back()->withErrors([
                    'email' => 'Akses ditolak. Akun ini bukan level staf/administrator.',
                ])->onlyInput('email');
            }

            request()->session()->regenerate();
            return redirect('/admin');
        }

        return back()->withErrors([
            'email' => 'Kredensial staf/operator tidak valid.',
        ])->onlyInput('email');
    });

    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');

    Route::post('/register', function () {
        $data = request()->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'phone' => 'nullable|string|max:20',
        ]);

        $user = \App\Models\User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'phone' => $data['phone'] ?? null,
            'role' => 'member',
        ]);

        auth()->login($user);

        return redirect()->route('member.dashboard');
    });
});

Route::post('/logout', function () {
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');

// Member routes
Route::middleware('auth')->prefix('member')->name('member.')->group(function () {
    // Dashboard - accessible even if expired
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Payment routes - accessible even if expired (for renewal)
    Route::prefix('payment')->name('payment.')->group(function () {
        Route::get('/create', [PaymentController::class, 'create'])->name('create');
        Route::post('/store', [PaymentController::class, 'store'])->name('store');
        Route::get('/history', [PaymentController::class, 'index'])->name('index');
    });

    // Progress routes - accessible for all members
    Route::prefix('progress')->name('progress.')->group(function () {
        Route::get('/', [ProgressController::class, 'index'])->name('index');
        Route::get('/create', [ProgressController::class, 'create'])->name('create');
        Route::post('/store', [ProgressController::class, 'store'])->name('store');
        Route::get('/{progress}/edit', [ProgressController::class, 'edit'])->name('edit');
        Route::put('/{progress}', [ProgressController::class, 'update'])->name('update');
        Route::delete('/{progress}', [ProgressController::class, 'destroy'])->name('destroy');
    });

    // Body Metrics routes
    Route::prefix('body-metrics')->name('body-metrics.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Member\BodyMetricController::class, 'index'])->name('index');
        Route::get('/create', [\App\Http\Controllers\Member\BodyMetricController::class, 'create'])->name('create');
        Route::post('/store', [\App\Http\Controllers\Member\BodyMetricController::class, 'store'])->name('store');
        Route::get('/chart-data', [\App\Http\Controllers\Member\BodyMetricController::class, 'getChartData'])->name('chart-data');
    });

    // Custom Workout Types routes
    Route::get('/workout-types', [\App\Http\Controllers\Member\CustomWorkoutTypeController::class, 'index'])->name('workout-types.index');
    Route::post('/custom-workout-types', [\App\Http\Controllers\Member\CustomWorkoutTypeController::class, 'store'])->name('custom-workout-types.store');
    Route::post('/workout-types', [\App\Http\Controllers\Member\CustomWorkoutTypeController::class, 'store'])->name('workout-types.store');

    // Transactions alias for payment history
    Route::get('/transactions', [PaymentController::class, 'index'])->name('transactions');

    // Protected routes - only for active members
    Route::middleware('check.membership')->group(function () {
        Route::get('/workout-plans', [WorkoutPlanController::class, 'index'])->name('workout-plans');
        Route::get('/workout-plans/{workoutPlan}', [WorkoutPlanController::class, 'show'])->name('workout-plans.show');
    });
});
