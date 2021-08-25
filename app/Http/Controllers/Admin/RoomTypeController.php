<?php

namespace App\Http\Controllers\admin;

use com;
use App\Models\Room;
use App\Models\Roomtype;
use Faker\Provider\Lorem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\admin\RoomController;

class RoomTypeController extends Controller
{
    public function index()
    {
        $allRoomType =  Roomtype::orderby('count_room', 'desc')->get();
        return view('admin.room_type.all', compact('allRoomType'));
    }

    public function add()
    {
        return view('admin.room_type.add');
    }

    public function store(Request $request)
    {
        $request->validate($this->rules());
        Roomtype::create([
            'type' => $request->type,
            'price' => $request->price,
            'description' => $request->description,
        ]);
        return redirect()->back()->with(['success' => 'Room Type Added Successfully']);
    }


    public function edit($room_type_id)
    {
        $room_type = Roomtype::find($room_type_id);
        return view('admin.room_type.update', compact('room_type'));
    }

    public function update(Request $request)
    {
        $request->validate($this->rules_update($request->type_id));
        $room_type = $this->findOrNot($request->type_id);
        if ($room_type) {
            $room_type->update([
                'type' => $request->type,
                'description' => $request->description,
                'price' => $request->price,
            ]);
            return redirect()->back()->with(['success' => 'Room Type update successfully']);
        }
    }


    public function delete(Request $request)
    {
        return $request;
    }


    private function rules()
    {
        return [
            'type' => 'required|unique:roomtypes,type',
            'price' => 'required|numeric',
            'description' => 'required'
        ];
    }

    private function rules_update($id)
    {
        return [
            'type' => 'required|unique:roomtypes,type,' . $id,
            'price' => 'required|numeric',
            'description' => 'required'
        ];
    }

    private function findOrNot($id)
    {
        $room_type = Roomtype::find($id);
        if ($room_type) {
            return $room_type;
        } else {
            return false;
        }
    }
}
