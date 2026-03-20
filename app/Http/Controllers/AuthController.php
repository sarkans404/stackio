<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|min:2|max:50',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        $id = $user->id;

        return redirect()->route('user.profile', $id);
    }

    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            return redirect()->route('home');

        }

        return back()->withErrors([
            'email' => 'Invalid credentials',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }

    public function delete(Request $request)
    {
        if (! Auth::check()) {
            return redirect()->route('home');
        }
        if (Auth::id() != $request->user_id) {
            return redirect()->route('home');
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $user = User::where('id', $request->user_id)->get();
        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }
        User::where('id', $request->user_id)->delete();

        return redirect()->route('home');
    }
}
