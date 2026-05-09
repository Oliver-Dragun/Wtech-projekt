<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\CartController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

// Handles the login form, login submission, logout and session management.
class AuthenticatedSessionController extends Controller
{
    // Renders the login form and returns user to the last visited page after login
    public function create(): View
    {
        if (request()->has('redirect')) {
            session()->put('url.intended', request('redirect'));
        }

        return view('auth.login');
    }

    // Validates credentials, creates logged in session, merge guest cart into the user's cart
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        CartController::mergeGuestCart();

        return redirect()->intended('/');
    }

    // Logout with session wipe and refresh
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        // Wipes all session data (including any leftover guest cart).
        $request->session()->invalidate();

        // Issues a fresh CSRF token so the next form submission isn't
        // reusing the logged-out session's token.
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
