<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function fetchNotifications()
{
    if (!Auth::check()) {
        return response()->json(['error' => 'User not authenticated'], 401);
    }

    $notifications = Notification::where('user_id', Auth::id())
        ->orderBy('time_created', 'desc')
        ->get();

    return response()->json(['notifications' => $notifications]);
}

}
