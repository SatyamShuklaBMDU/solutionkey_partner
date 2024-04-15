<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ZipcodeStateCity;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $zip = ZipcodeStateCity::all();
        $users = User::all();
        return view('users.user', compact('zip', 'users'));
    }

    public function getCityState(Request $request)
    {
        $pincode = $request->input('pincode');
        $data = ZipcodeStateCity::where('Pincode', $pincode)->first();
        if ($data) {
            return response()->json(['city' => $data->City, 'state' => $data->State]);
        } else {
            return response()->json(['city' => '', 'state' => '']);
        }
    }

    public function changeStatus(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'status' => 'required|in:active,inactive',
        ]);
        // dd($request->user_id);
        $userId = $request->input('user_id');
        $status = $request->input('status');
        $user = User::findOrFail($userId);
        $user->status = $status;
        $user->save();
        return response()->json(['message' => 'User status updated successfully.']);
    }
    public function deleteUser(Request $request)
    {
        $user_id = $request->user_id;
        $user = User::findOrFail($user_id);
        $user->delete();
        return response()->json(['message' => 'User deleted successfully.']);
    }

    public function filter(Request $request)
    {
        $request->validate([
            'start' => 'required',
            'end' => 'required',
        ]);
        $start = $request->input('start');
        $end = $request->input('end');
        $carbonStart = Carbon::createFromFormat('d/m/Y', $start)->startOfDay();
        $carbonEnd = Carbon::createFromFormat('d/m/Y', $end)->endOfDay();
        $users = User::whereBetween('created_at', [$carbonStart, $carbonEnd])->get();
        // dd($users);
        return view('users.user', compact('users','start','end'));
    }
}
