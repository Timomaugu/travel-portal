<?php

use App\Models\Requisition;
use App\Models\Message;
use App\Models\Conversation;

if (! function_exists('time_interval')) {
    function time_interval($date) {
        $now = new DateTime(now());
        $interval = $date->diff($now);

        $timeParts = [];

        if ($interval->d > 0) {
            $timeParts[] = $interval->d . " day" . ($interval->d > 1 ? "s" : "");
        }
        if ($interval->h > 0) {
            $timeParts[] = $interval->h . " hr" . ($interval->h > 1 ? "s" : "");
        }
        if ($interval->i > 0) {
            $timeParts[] = $interval->i . " min" . ($interval->i > 1 ? "s" : "");
        }
        // if ($interval->s > 0) {
        //     $timeParts[] = $interval->s . " sec" . ($interval->s > 1 ? "s" : "");
        // }

        $formattedInterval = implode(" ", $timeParts);

        return ($formattedInterval ? $formattedInterval : "0 seconds");
    }
}

if (! function_exists("get_user")) {
    function get_user() {
        $user = auth()->user();

        return $user;
    }

}

if (! function_exists("get_requisitions")) {
    function get_requisitions($status) {
        
        $user = auth()->user();
        $role = $user->roles->value('name');
        
        $requisitions = Requisition::when(function ($query) use ($status, $user, $role) {

            switch ($role) {
                case 'staff':
                    if($status == '') {
                        $query->where('user_id', $user->id); return;
                    }
                    $query->where('status', $status)->where('user_id', $user->id);
                    break;

                case 'hod-agm-gm':
                    if ($status == '') {
                        $query->where('department_id', $user->department_id); return;
                    }
                    
                    $query->where('status', $status)->where('department_id', $user->department_id)->where('hod_agm_gm_approved', $status);
                    break;

                case 'dept-adm':
                    $query->where('status', 1);
                    break;

                case 'director':
                    if ($status == '') {
                        $query->where('director_approved', '<>', NULL); return;
                    }
                    $query->where('status', $status)->where('director_approved', $status);
                    break;

                case 'ceo':
                    if ($status == '') {
                        $query->where('ceo_approved', '<>', NULL); return;
                    }
                    $query->where('status', $status)->where('ceo_approved', $status);
                    break;

                case 'super-admin':
                    if ($status == '') {
                        return;
                    }
                    $query->where('status', $status);
                    break;
                
                default:
                    # code...
                    break;
            }
        })->orderBy("id", "desc")->get();

        return $requisitions;
    }

}

if (! function_exists("getNotifications")) {
    function getNotifications() {
        $notifications = auth()->user()->notifications()->where('status', 0)->orderBy('id', 'desc')->get();

        return $notifications;
    }

}

if (! function_exists("getConversations")) {
    function getConversations() {
        $userId = auth()->user()->id;
        $conversations = Conversation::where(function ($query) use ($userId) {
            $query->where('sender_id', $userId);
        })->orWhere(function ($query) use ($userId) {
            $query->where('receiver_id', $userId);
        })->get();

        return $conversations;
    }
}


if (! function_exists("getMessages")) {
    function getMessages($conversationId) {
        $userId = auth()->user()->id;
        $messages = Message::where('conversation_id', $conversationId)->where(function ($query) use ($userId) {
            $query->where('sender_id', $userId);
        })->orWhere(function ($query) use ($userId) {
            $query->where('receiver_id', $userId);
        })->get();

        return $messages;
    }
}
