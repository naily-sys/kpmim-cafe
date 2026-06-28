<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OwnerLoginController extends Controller
{
    public function create()
    {
        return view('auth.owner-login');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();

            if (Auth::user()->role === 'owner') {
                return redirect()->route('owner.dashboard');
            }

            // If not an owner, log them out
            Auth::logout();
            return back()->with('error', 'This account is not registered as an owner.');
        }

        return back()->withErrors([
            'email' => 'These credentials do not match our records.',
        ]);
    }
}