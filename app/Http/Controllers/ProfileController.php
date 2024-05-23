<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(Request $request)
    {
        $user = Auth::guard('admins')->user();
        return view('profile.edit', compact('user'));
    }

    public function storebasic(Request $request)
    {
        // dd($request->all());
        $user = Auth::guard('admins')->user();
        $user->gender = $request->gender;
        $user->mobile_no = $request->phone_number;
        $user->email = $request->email;
        $user->name = $request->name;
        $user->appointment_charge = $request->appointment;
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $photoFileName = uniqid() . '.' . $request->image->extension();
            $photoPath = $request->file('image')->move(public_path('ProfilePic'), $photoFileName);
            $photoRelativePath = 'ProfilePic/' . $photoFileName;
            $user->profile_pic = $photoRelativePath;
        }
        $user->save();
        return back()->with('success', 'Basic Details Updated Successfully');
    }
    public function storeContact(Request $request)
    {
        // dd($request->all());
        $user = Auth::guard('admins')->user();
        $user->address = $request->address;
        $user->state = $request->state;
        $user->country = $request->country;
        $user->pincode = $request->pincode;
        $user->specialization = $request->specialization;
        $user->save();
        return back()->with('success', 'Contact Details Updated Successfully');
    }
    public function storePassword(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);
        if (!Hash::check($request->old_password, Auth::guard('admins')->user()->password)) {
            return back()->withErrors(['old_password' => 'The provided password does not match our records.']);
        }
        $user = Auth::guard('admins')->user();
        $user->password = Hash::make($request->new_password);
        $user->save();
        return back()->with('success', 'Password successfully changed.');
    }

    public function changeStatus(Request $request)
    {
        $user = Auth::guard('admins')->user();
        // dd($request->status);
        $user->status = $request->status;
        $user->save();
        return redirect()->back()->with('success','Status Change Successfully.');
    }

}
