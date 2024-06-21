<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\ReminderServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ReminderController extends Controller
{
    protected $reminderServices;

    public function __construct(ReminderServices $ReminderServices)
    {
        $this->reminderServices = $ReminderServices;
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'start_date' => 'required|date|string',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $login = Auth::user();
        $reminder = $this->reminderServices->setReminder($validator->validated(), $login);
        return response()->json(['message' => 'Reminder added successfully', 'reminder' => $reminder], Response::HTTP_CREATED);
    }

    public function getReminder()
    {
        $login = Auth::user();
        $reminders = $this->reminderServices->getReminder($login->id);
        return response()->json(['reminders' => $reminders], Response::HTTP_OK);
    }
}
