<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Analytics extends Controller
{
  public function index()
  {



    return view('content.dashboard.dashboards-analytics');
  }
  public function getNotifications()
  {
    $notifications = notification::all();
    return response()->json(['notifications' => $notifications]);
  }
  public function markAsRead(Request $request)
  {
    // Use a direct database query to mark all notifications as read
    DB::table('notifications')->update(['read' => true]);

    return response()->json(['message' => 'Notifications marked as read']);
  }
  public function delete($id)
  {
    try {
      $notification = Notification::findOrFail($id);

      // Perform any additional logic here before deletion, if needed

      $notification->delete();

      return response()->json(['success' => true, 'message' => 'Notification deleted successfully']);
    } catch (\Exception $e) {
      return response()->json(['success' => false, 'message' => 'Failed to delete notification.']);
    }
  }
}
