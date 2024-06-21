<?php

namespace App\Services;

use App\Models\Task;
use Carbon\Carbon;

class TaskServices
{
    public function addTask(array $data, $login)
    {
        return Task::create([
            'vendor_id'=>$login->id,
            'name'=>$data['name'],
            'start_date' => Carbon::parse($data['start_date'])->format('Y-m-d'),
            'end_date' => Carbon::parse($data['end_date'])->format('Y-m-d'),
        ]);
    }

    public function getTasks(int $login)
    {
        return Task::where('vendor_id', $login)->latest()->get();
    }
}
