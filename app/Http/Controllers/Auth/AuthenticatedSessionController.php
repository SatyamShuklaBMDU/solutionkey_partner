<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $admin = Admin::where('email', $request->email)->first();
        if (!$admin) {
            return back()->withErrors(['email' => 'These credentials do not match our records.']);
        }
        // dd(Hash::make('12345678'));
        if (Hash::check($request->password, $admin->password)) {
            // dd('1');
            auth()->guard('admins')->login($admin);
            $request->session()->regenerate();
            return redirect('/dashboard');
        }

        return back()->withErrors(['email' => 'These credentials do not match our records.']);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)
    {
        auth()->guard('admins')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
