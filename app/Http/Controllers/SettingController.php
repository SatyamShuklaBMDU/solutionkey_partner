<?php

namespace App\Http\Controllers;

use App\Models\AccountDetails;
use App\Models\DoctorTimeSlot;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    public function index()
    {
        $user = Auth::guard('admins')->user();
        $timeSlots = $this->generateTimeSlots();
        $account = AccountDetails::where('doctor_id',Auth::guard('admins')->id())->first();
        return view('setting.setting', compact('timeSlots','account','user'));
    }

    private function generateTimeSlots()
    {
        $start = Carbon::today()->setTime(0, 0);
        $end = Carbon::today()->setTime(23, 30);
        $slots = [];

        while ($start <= $end) {
            $slots[] = $start->format('h:i A');
            $start->addMinutes(30);
        }

        return $slots;
    }
    public function storeTimeSlots(Request $request)
    {
        $user = Auth::guard('admins')->user();
        $validatedData = $request->validate([
            'time_slots_online' => 'required|array',
            'time_slots_offline' => 'required|array',
            'time_slots_online.*' => 'string',
            'time_slots_offline.*' => 'string',
        ]);
        $userId = $user->id;
        $onlineSlots = $validatedData['time_slots_online'];
        $offlineSlots = $validatedData['time_slots_offline'];
        foreach ($onlineSlots as $slot) {
            DoctorTimeSlot::create([
                'doctor_id' => $userId,
                'time_slot' => $slot,
                'type' => 'online',
            ]);
        }
        foreach ($offlineSlots as $slot) {
            DoctorTimeSlot::create([
                'doctor_id' => $userId,
                'time_slot' => $slot,
                'type' => 'offline',
            ]);
        }
        return redirect()->back()->with('success', 'Time slots saved successfully.');
    }
    public function storeBankInfo(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'account_number' => 'required',
            'ifsc' => 'required',
            'bankname' => 'required',
            'branchname' => 'required',
            'customername' => 'required',
            'upi_id' => 'required',
            'upi_number' => 'required',
        ]);
        $doctorId = Auth::guard('admins')->id();
        $data = [
            'aacount_number' => $request->input('account_number'),
            'ifsc' => $request->input('ifsc'),
            'bank_name' => $request->input('bankname'),
            'branch_name' => $request->input('branchname'),
            'customer_name' => $request->input('customername'),
            'upi_id' => $request->input('upi_id'),
            'upi_number' => $request->input('upi_number'),
        ];
        AccountDetails::updateOrCreate(
            ['doctor_id' => $doctorId],
            $data
        );
        return redirect('setting')->with('success', 'Account Details Updated.');
    }

}
