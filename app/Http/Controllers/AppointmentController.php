<?php

namespace App\Http\Controllers;

use App\Models\Appointement;

class AppointmentController extends Controller
{
    public function index()
    {
        return view('appointment.index');
    }

    public function getdynamically()
    {
        $appointments = Appointement::all();
        return response()->json($appointments);
    }

    public function getHistory()
    {
        return view('appointment.history');
    }
}
