<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $user = auth()->user();
        $selectedRole = $request->input('role');

        if ($selectedRole && $user->role !== $selectedRole) {
            Auth::guard('web')->logout();
            $request->session()->regenerateToken();

            return back()->withErrors([
                'email' => 'Akun ini tidak sesuai dengan peran yang dipilih.',
            ])->onlyInput(['email', 'role']);
        }

        $request->session()->regenerate();

        $dashboardRoute = $user->dashboardRouteName();

        return $dashboardRoute
            ? redirect()->route($dashboardRoute)
            : redirect()->route('beranda');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('beranda');
    }
}
