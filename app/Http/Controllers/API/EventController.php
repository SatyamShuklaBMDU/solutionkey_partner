<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\EventServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class EventController extends Controller
{
    protected $eventServices;

    public function __construct(EventServices $EventServices)
    {
        $this->eventServices = $EventServices;
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
        $Event = $this->eventServices->addEvent($validator->validated(), $login);
        return response()->json(['message' => 'Event added successfully', 'Event' => $Event], Response::HTTP_CREATED);
    }

    public function getEvent()
    {
        $login = Auth::user();
        $Events = $this->eventServices->getEvent($login->id);
        return response()->json(['Events' => $Events], Response::HTTP_OK);
    }
}
