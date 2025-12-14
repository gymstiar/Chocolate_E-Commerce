<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Get notifications for current user.
     */
    public function index(Request $request)
    {
        $notifications = Notification::forUser(auth()->id())
            ->orderBy('created_at', 'desc')
            ->take(20)
            ->get();

        return response()->json([
            'notifications' => $notifications->map(function ($n) {
                return [
                    'id' => $n->id,
                    'type' => $n->type,
                    'title' => $n->title,
                    'message' => $n->message,
                    'link' => $n->link,
                    'icon' => $n->icon,
                    'time_ago' => $n->time_ago,
                    'is_read' => $n->isRead(),
                    'created_at' => $n->created_at->format('Y-m-d H:i:s'),
                ];
            }),
            'unread_count' => Notification::forUser(auth()->id())->unread()->count(),
        ]);
    }

    /**
     * Get unread count only (for polling).
     */
    public function unreadCount()
    {
        $count = Notification::forUser(auth()->id())->unread()->count();
        
        // Also get latest unread notifications for toast
        $latest = Notification::forUser(auth()->id())
            ->unread()
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get(['id', 'type', 'title', 'message', 'link', 'created_at']);

        return response()->json([
            'count' => $count,
            'latest' => $latest->map(function ($n) {
                return [
                    'id' => $n->id,
                    'type' => $n->type,
                    'title' => $n->title,
                    'message' => $n->message,
                    'link' => $n->link,
                    'icon' => $n->icon,
                ];
            }),
        ]);
    }

    /**
     * Mark notification as read.
     */
    public function markAsRead(Notification $notification)
    {
        if ($notification->user_id !== auth()->id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $notification->markAsRead();

        return response()->json(['success' => true]);
    }

    /**
     * Mark all notifications as read.
     */
    public function markAllRead()
    {
        Notification::forUser(auth()->id())
            ->unread()
            ->update(['read_at' => now()]);

        return response()->json(['success' => true]);
    }

    /**
     * Create a notification (helper method).
     */
    public static function create($userId, $type, $title, $message, $link = null, $data = null)
    {
        return Notification::create([
            'user_id' => $userId,
            'type' => $type,
            'title' => $title,
            'message' => $message,
            'link' => $link,
            'data' => $data,
        ]);
    }
}
