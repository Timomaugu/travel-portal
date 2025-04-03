<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function index() {
        $notifications = Notification::all();
    }

    public function readOne($id) {
        $notification = Notification::findorFail($id);
        $notification->status = 1;
        $notification->save();

        $requisitions = $notification->requisition()->get();

        return view('requests.index', compact('requisitions'))->with(["status"=> "Notification Viewed"]);

    }

    public function readAll() {
        $notifications = Notification::where('status', 0)->where('user_id', auth()->id())->get();
        $requisitions = [];
        foreach($notifications as $notification) {
            array_push($requisitions, $notification->requisition()->get());
            $notification->status = 1;
            $notification->save();
        }

        return view('requests.index', compact('requisitions'))->with(["status"=> "All Notifications Viewed"]);

    }

    public function markasRead() {   
        $notifications = Notification::where('status', 0)->where('user_id', auth()->id())->get();
        foreach($notifications as $notification) {
            $notification->status = 1;
            $notification->save();
        }
        
        return redirect()->back()->with(["status"=> "All Marked as Read"]);
    }
}
