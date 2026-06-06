<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            // Redirect to first visible page if home is hidden
            $homeVisible = Page::where('route_name', 'home')->where('is_visible', true)->exists();
            $target = $homeVisible ? route('home') : (Page::where('is_visible', true)->first()?->route_name ?? 'home');

            return redirect()->intended($homeVisible ? route('home') : route($target));
        }

        throw ValidationException::withMessages([
            'email' => __('auth.failed'),
        ]);
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user', // Default role
        ]);

        Auth::login($user);

        $homeVisible = Page::where('route_name', 'home')->where('is_visible', true)->exists();
        $target = $homeVisible ? 'home' : (Page::where('is_visible', true)->first()?->route_name ?? 'home');
        return redirect()->route($target);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $homeVisible = Page::where('route_name', 'home')->where('is_visible', true)->exists();
        $target = $homeVisible ? 'home' : (Page::where('is_visible', true)->first()?->route_name ?? 'home');
        return redirect()->route($target);
    }
}
