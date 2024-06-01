<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required','unique:'.Admin::class,'min:10'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.Admin::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        $randomDigits = mt_rand(10000, 99999);
        $vendorid = 'VEND' . $randomDigits;
        $user = Admin::create([
            'vendor_id'=>$vendorid,
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' =>$request->mobile_no,
            'password' => Hash::make($request->password),
        ]);
        event(new Registered($user));
        Auth::guard('admins')->login($user);
        return redirect(RouteServiceProvider::HOME);
    }
}
