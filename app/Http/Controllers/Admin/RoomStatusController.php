<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomStatusController extends Controller
{
    public function not_reservation()
    {
        $all_room =  Room::where('status', 1)->get();
        return view('admin.room.room_not_reservation', compact('all_room'));
    }
    public function reservation()
    {
        $all_room = Room::where('status', 2)->get();
        return view('admin.room.room_not_reservation', compact('all_room'));
    }
}
