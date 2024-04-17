<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.add_admin');
    }
    public function showadmin()
    {
        $admins = Admin::where('role','!=','SuperAdmin')->get();
        // dd($admins);
        return view('admin.all_admin',compact('admins'));
    }
    public function changeStatus(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'status' => 'required',
        ]);
        // dd($request->user_id);
        $userId = $request->input('user_id');
        $status = $request->input('status');
        $user = Admin::findOrFail($userId);
        $user->status = $status;
        $user->save();
        return response()->json(['message' => 'User status updated successfully.']);
    }
    public function deleteAdmin(Request $request)
    {
        $user_id = $request->user_id;
        $user = Admin::findOrFail($user_id);
        $user->delete();
        return response()->json(['message' => 'User deleted successfully.']);
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:6',
            'role' => 'required',
            'permission' => 'required|array',
            // 'mobile_no' => 'required|numeric|digits:10|unique:admins,mobile_no,'.$id,
            'mobile_no' => 'required|numeric|digits:10|unique:admins'
        ]);
        $admin = new Admin();
        $admin->name = $request->input('name');
        $admin->email = $request->input('email');
        $admin->password = Hash::make(($request->input('password'))); 
        $admin->role = $request->input('role');
        $admin->permission = json_encode($request->input('permission'));
        $admin->mobile_no = $request->input('mobile_no');
        $admin->save();
        return redirect('/all-admin')->with('message','Admin created successfully');
    }
    public function editAdmin($id)
    {
        $id = $id ? decrypt($id) : "";
        $admin = Admin::findOrFail($id);
        return view('admin.edit_admin',compact('admin'));
    }
    public function update_admin($id, Request $request)
    {
        $id = $id ? decrypt($id) : "";
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admins,email,'.$id,
            'role' => 'required',
            'permission' => 'required|array',
            'mobile_no' => 'required|numeric|digits:10|unique:admins,mobile_no,'.$id,
        ]);
        $admin = Admin::findOrFail($id);
        $admin->name = $request->input('name');
        $admin->email = $request->input('email');
        $admin->role = $request->input('role');
        $admin->permission = json_encode($request->input('permission'));
        $admin->mobile_no = $request->input('mobile_no');
        $admin->save();
        return redirect('/all-admin')->with('message',' Updated successfully');
    }
}
