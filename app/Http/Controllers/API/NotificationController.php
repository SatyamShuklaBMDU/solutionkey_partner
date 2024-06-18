<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\NotificationFor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $notifications = NotificationFor::where('for','all')->orWhere('for','vendor')->latest()->get();
        return response()->json($notifications,Response::HTTP_OK);
    }

    public function getNotify(Request $request)
    {
        $vendor = Auth::user();
        // dd($vendor instanceof \App\Models\Admin);
        $notifications = [];
        foreach (Auth::user()->unreadNotifications as $notification) {
            $notification->markAsRead();
            if ($notification['type'] == "App\Notifications\NewFollow") {
                $notifications[] = [
                    'type' => 'follow',
                    'user' => Admin::findOrfail($notification['data']['follower_id']),
                ];
            }
        }
        return response()->json($notifications);
    }
}
