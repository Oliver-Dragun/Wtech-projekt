<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\CartController;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

// Handles registration
class RegisteredUserController extends Controller
{
    // Render registration form
    public function create(): View
    {
        if (request()->has('redirect')) {
            session()->put('url.intended', request('redirect'));
        }

        return view('auth.register');
    }

    // Validates form, creates new user account and logs in
    public function store(Request $request): RedirectResponse
    {
        // Validate form data: enforce string max length, email uniqueness, password and repeat password match
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Creates user and hashes password for safety
        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        CartController::mergeGuestCart();

        return redirect()->intended('/');
    }
}
