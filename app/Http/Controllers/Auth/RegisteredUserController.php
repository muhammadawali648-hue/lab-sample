<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:users,username', 'regex:/^[a-zA-Z]+$/'],
            'password' => ['required', 'confirmed', Rules\Password::defaults(), 'regex:/^[a-zA-Z]/'],
        ], [
            'username.regex' => 'Username hanya boleh mengandung huruf, tidak boleh angka atau karakter khusus.',
            'password.regex' => 'Password harus dimulai dengan huruf, tidak boleh angka atau karakter khusus di karakter pertama.',
        ]);

        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        // ✅ Auto login dan redirect ke dashboard
        auth()->login($user);
        
        return redirect()->route('dashboard')
            ->with('success', 'Registrasi berhasil! Selamat datang.');
    }
}