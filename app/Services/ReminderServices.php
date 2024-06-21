<?php

namespace App\Services;

use App\Models\Reminder;
use Carbon\Carbon;

class ReminderServices
{
    public function setReminder(array $data,$login)
    {
        return Reminder::create([
            'vendor_id'=>$login->id,
            'name'=>$data['name'],
            'start_date' => Carbon::parse($data['start_date'])->format('Y-m-d'),
            'end_date' => Carbon::parse($data['end_date'])->format('Y-m-d'),
        ]);
    }

    public function getReminder(int $login)
    {
        return Reminder::where('vendor_id',$login)->latest()->get();
    }
}
