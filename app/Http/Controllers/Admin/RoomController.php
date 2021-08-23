<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Roomtype;
use Illuminate\Http\Request;
use PDO;

class RoomController extends Controller
{
    public function index()
    {
        return view('admin.room.all');
    }

    public function add()
    {
        $roomTypes = Roomtype::all();
        return view('admin.room.add', compact('roomTypes'));
    }

    public function type_info($id)
    {
        return  Roomtype::find($id);
    }


    public function store(Request $request)
    {

        // validate don't work
        $request->validate([
            'roomtype' => 'required',
            'images' => 'required',
            'images.*' => 'mimes:png,jpg,jpeg',
        ]);

        // if i upload image reuturn 'not found images' maybe function hasFile don't work 
        if ($request->hasFile('images')) {
            return 'found images';
        } else {
            return 'not found images';
        }
    }
}
