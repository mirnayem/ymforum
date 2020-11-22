<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\NotificationResource;

class NotificationController extends Controller
{
    public function index(){

        $read = NotificationResource::collection(auth()->user()->readNotifications);
        $unread = NotificationResource::collection(auth()->user()->unreadNotifications);

        return [
           'read' => $read , 'unread' => $unread
        ];
    }

    public function markedAsRead(Request $request){
       auth()->user()->notifications->where('id' , $request->id)->markAsRead();
    }
}
