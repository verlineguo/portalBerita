<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index($role)
    {
        $user = Auth::user();

        $roleMap = [
            0 => 'admin',
            1 => 'writer',
            2 => 'visitor',
        ];

        // Bandingkan string role
        if (!isset($roleMap[$user->role]) || $roleMap[$user->role] !== $role) {
            abort(403, 'Unauthorized action.');
        }

        $notifications = $user->notifications()->paginate(10);

        return view("$role.notifications.index", compact('notifications'));
    }

    public function markAsRead($id)
    {
        $user = Auth::user();
        $notification = $user->notifications()->where('id', $id)->first();

        if ($notification) {
            $notification->markAsRead();
        }

        return redirect()->back();
    }

    public function markAllAsRead()
    {
        $user = Auth::user();
        $user->unreadNotifications->markAsRead();

        return redirect()->back();
    }

    public function getUnreadCount()
    {
        $user = Auth::user();
        $count = $user->unreadNotifications->count();

        return response()->json(['count' => $count]);
    }

    // Method to format notifications for dropdown display
    public function getUnreadNotifications()
    {
        $user = Auth::user();
        $notifications = $user->unreadNotifications()->limit(5)->get();

        return response()->json(['notifications' => $notifications]);
    }

    public function destroy($id)
    {
        // Cari notifikasi berdasarkan ID
        $notification = Auth::user()->notifications()->findOrFail($id);

        // Hapus notifikasi
        $notification->delete();

        $roleMap = [
            0 => 'admin',
            1 => 'writer',
            2 => 'visitor',
        ];

        $user = Auth::user();
        $role = $roleMap[$user->role] ?? abort(403, 'Unauthorized action.');

        return redirect()
            ->route('notifications.index', ['role' => $role])
            ->with('success', 'Notification deleted successfully.');
    }
}
