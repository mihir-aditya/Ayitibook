<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /* ──────────────────────────────────────────────────────────
       GET /profile/notifications
       Renders the full notifications page
    ────────────────────────────────────────────────────────── */
    public function index(Request $request)
    {
        $user = Auth::user();

        $query = Notification::forUser($user->id)
            ->orderByDesc('created_at');

        // Optional filter: ?filter=unread
        if ($request->get('filter') === 'unread') {
            $query->unread();
        }

        $notifications = $query->paginate(20)->withQueryString();

        // Mark ALL as read when user opens the page
        Notification::forUser($user->id)->unread()->update(['read_at' => now()]);

        $unreadCount = 0; // just marked them all read

        return view('profile.notifications', compact('notifications', 'unreadCount'));
    }

    /* ──────────────────────────────────────────────────────────
       GET /notifications/unread-count  (AJAX – header badge)
    ────────────────────────────────────────────────────────── */
    public function unreadCount()
    {
        $count = Notification::forUser(Auth::id())->unread()->count();

        return response()->json(['count' => $count]);
    }

    /* ──────────────────────────────────────────────────────────
       POST /notifications/{id}/read  (AJAX – mark single read)
    ────────────────────────────────────────────────────────── */
    public function markRead(Notification $notification)
    {
        abort_if($notification->user_id !== Auth::id(), 403);

        $notification->markRead();

        return response()->json(['success' => true]);
    }

    /* ──────────────────────────────────────────────────────────
       POST /notifications/mark-all-read  (AJAX)
    ────────────────────────────────────────────────────────── */
    public function markAllRead()
    {
        Notification::forUser(Auth::id())->unread()->update(['read_at' => now()]);

        return response()->json(['success' => true]);
    }

    /* ──────────────────────────────────────────────────────────
       DELETE /notifications/{id}
    ────────────────────────────────────────────────────────── */
    public function destroy(Notification $notification)
    {
        abort_if($notification->user_id !== Auth::id(), 403);

        $notification->delete();

        if (request()->expectsJson()) {
            return response()->json(['success' => true]);
        }

        return back()->with('success', 'Notification deleted.');
    }

    /* ──────────────────────────────────────────────────────────
       DELETE /notifications/clear-all
    ────────────────────────────────────────────────────────── */
    public function clearAll()
    {
        Notification::forUser(Auth::id())->delete();

        if (request()->expectsJson()) {
            return response()->json(['success' => true]);
        }

        return back()->with('success', 'All notifications cleared.');
    }

    /* ──────────────────────────────────────────────────────────
       GET /notifications/latest  (AJAX dropdown – header bell)
       Returns the 8 most-recent notifications as JSON
    ────────────────────────────────────────────────────────── */
    public function latest()
    {
        $notifications = Notification::forUser(Auth::id())
            ->orderByDesc('created_at')
            ->limit(8)
            ->get()
            ->map(fn ($n) => [
                'id'         => $n->id,
                'type'       => $n->type,
                'title'      => $n->title,
                'message'    => $n->message,
                'data'       => $n->data,
                'read'       => $n->isRead(),
                'time'       => $n->created_at->diffForHumans(),
                'url'        => $n->data['url'] ?? null,
            ]);

        $unread = Notification::forUser(Auth::id())->unread()->count();

        return response()->json(compact('notifications', 'unread'));
    }
}