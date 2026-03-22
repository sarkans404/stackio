<?php

namespace App\Http\Controllers;

use App\Models\Notifications;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notifications::with('actor', 'notifiable')
            ->where('user_id', Auth::id())
            ->where('is_read', false)
            ->latest()
            ->get();

        return view('notification', compact('notifications'));
    }

    public function markAllRead()
    {
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        Notifications::where('user_id', Auth::id())
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return redirect()->route('notification.show');
    }
}
