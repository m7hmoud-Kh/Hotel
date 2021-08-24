<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Roomtype;
use Illuminate\Http\Request;

class RoomTypeController extends Controller
{
    public function index()
    {
        $allRoomType =  Roomtype::all();
        return view('admin.room_type.all',compact('allRoomType'));
    }
}
