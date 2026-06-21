<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone_number' => ['nullable', 'string', 'regex:/^[0-9]{1,11}$/'],
            'password' => 'required|min:6|confirmed',
        ], [
            'phone_number.regex' => 'The phone number must be between 1 and 11 digits and contain only numbers.',
        ]);

        $prefix = 'C';

        $lastUser = User::where('id', 'like', $prefix . '%')
            ->orderBy('id', 'desc')
            ->first();

        $newNumber = $lastUser
            ? ((int) substr($lastUser->id, 1)) + 1
            : 1;

        $newId = $prefix . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

        User::create([
            'id' => $newId,
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'role' => 'customer',
            'approval_status' => 'pending',
            'email_verified_at' => null,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')
            ->with('success', 'Account created successfully. Please wait for admin approval.');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (
            $user &&
            $user->role === 'customer' &&
            $user->approval_status !== 'approved'
        ) {
            return back()->withErrors([
                'email' => 'Your account is pending admin approval.',
            ])->withInput();
        }

        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return back()->withErrors([
                'email' => 'Invalid email or password.',
            ])->withInput();
        }

        $request->session()->regenerate();

        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if ($user->role === 'technician') {
            return redirect()->route('technician.dashboard');
        }

        return redirect()->route('customer.dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('customer.home');
    }
}