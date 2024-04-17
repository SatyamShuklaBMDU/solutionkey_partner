<?php

namespace App\Http\Controllers;

use App\Models\UserMaster;
use Illuminate\Http\Request;

class UserManagerController extends Controller
{
    public function index()
    {
        return view('UserMaster.add_user');
    }

    public function show()
    {
        $users = UserMaster::all();
        return view('UserMaster.all_user',compact('users'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:user_masters',
            'phone_number' => 'required|string|regex:/^[0-9]{10,}$/',
        ]);        
        $photoRelativePath = null;
        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            $photoFileName = uniqid() . '.' . $request->photo->extension();
            $photoPath = $request->file('photo')->move(public_path('user_manager_images'), $photoFileName);
            $photoRelativePath = 'user_manager_images/' . $photoFileName;
        }
        $uniqid = 'UID' . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
        UserMaster::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone_number'=>$request->phone_number,
            'photo'=>$photoRelativePath,
            'user_generated_id'=>$uniqid,
            'status'=>'active',
        ]);
        return redirect()->route('add.user.master.show')->with('success', 'User created successfully.');
    }

    public function edit($id)
    {
        $Did = decrypt($id);
        $user = UserMaster::findOrFail($Did);
        // dd($user);
        return view('UserMaster.add_user', compact('user'));
    }

    public function update(Request $request, $id)
    {
        // dd($id);
        $Did = decrypt($id);
        $user = UserMaster::findOrFail($Did);
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone_number' => 'required|string|regex:/^[0-9]{10,}$/',
        ]);
        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            $photoFileName = uniqid() . '.' . $request->photo->extension();
            $photoPath = $request->file('photo')->move(public_path('user_manager_images'), $photoFileName);
            $photoRelativePath = 'user_manager_images/' . $photoFileName;
            $user->update(['photo' => $photoRelativePath]);
        }
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
        ]);
        return redirect()->route('add.user.master.show')->with('success', 'User updated successfully.');
    }
    public function destroy(Request $request)
    {
        $user_id = $request->user_id;
        $user = UserMaster::findOrFail($user_id);
        $user->delete();
        return response()->json(['message' => 'User deleted successfully.']);
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
        $user = UserMaster::findOrFail($userId);
        $user->status = $status;
        $user->save();
        return response()->json(['message' => 'User status updated successfully.']);
    }
}
