<?php

namespace App\Services;

use App\Models\Event;
use Carbon\Carbon;

class EventServices
{
    public function addEvent(array $data,$login)
    {
        return Event::create([
            'vendor_id'=>$login->id,
            'name'=>$data['name'],
            'start_date' => Carbon::parse($data['start_date'])->format('Y-m-d'),
            'end_date' => Carbon::parse($data['end_date'])->format('Y-m-d'),
        ]);
    }

    public function getEvent(int $login)
    {
        return Event::where('vendor_id',$login)->latest()->get();
    }
}
