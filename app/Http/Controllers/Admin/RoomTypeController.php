<?php

namespace App\Http\Controllers\admin;

use App\Models\Roomtype;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        $type = $this->findOrNot($request->type_id);
        if ($type) {
            $type->forceDelete();
            return redirect()->back()->with(['delete' => 'Room Type is Deleted All']);
        }
    }


    public function Archive(Request $request)
    {
        $type = $this->findOrNot($request->type_id);
        if ($type) {
            $type->Delete();
            return redirect()->back()->with(['archive' => 'Room Type is Archive']);
        }
    }


    public function all_archive()
    {
        $allRoomType = Roomtype::onlyTrashed()->get();
        return view('admin.room_type.all_archive', compact('allRoomType'));
    }

    public function cancel_archive(Request $request)
    {
        Roomtype::onlyTrashed()->where('id', $request->type_id)->restore();
        return redirect()->back()->with(['archive' => 'Room Type is Not Archive']);
    }

    public function delete_archive(Request $request)
    {
        $room_type = Roomtype::onlyTrashed()->where('id', $request->type_id);
        if ($room_type) {
            $room_type->forceDelete();
            return redirect()->back()->with(['delete' => 'Room Type is Deleted All']);
        }
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
