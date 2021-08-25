<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\RoomImage;
use App\Models\Roomtype;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PDO;
use com;

class RoomController extends Controller
{
    const PATH_IMAGE = 'images/rooms/';
    private $random = [];


    public function index()
    {

        $all_room = $this->all_info_about_room();
        return view('admin.room.all', compact('all_room'));
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
        $request->validate($this->rules());
        $files = $this->generation_file_name($request->images);
        $id = $this->store_room_image_and_save_latest_id($files);
        $this->store_room($request->roomtype, $id);
        $path = $this->generation_path_image();
        $this->save_image_in_local_storage($request->images, $path);
        $this->increment_count_room($request->roomtype);
        return redirect()->back()->with(['success' => 'room added successfully']);
    }



    public function edit($id)
    {
        $roomTypes = Roomtype::all();
        $all_info_about_room =  Room::with(['roomtype' => function ($q) {
            return $q->select('id', 'type', 'description', 'price');
        }])->with(['room_image' => function ($q) {
            return $q->select('id', 'filenames');
        }])->find($id);
        return view('admin.room.update', compact('roomTypes', 'all_info_about_room'));
    }

    public function update(Request $request)
    {
        $room = $this->findOrNot($request->room_id);
        if ($room) {
            if ($request->hasFile('images')) {
                // delete all image in this directory
                Storage::disk('rooms')->deleteDirectory($request->image_id);

                //update all image is upload in database
                $files = $this->generation_file_name($request->images);
                $images = RoomImage::find($request->image_id);
                $images->update([
                    'filenames' => $files,
                ]);

                //update all image is upload in localStorage
                $path =  $this->generation_path_image();
                $this->save_image_in_local_storage($request->images, $path);
            }
            $room->update([
                'type_id' => $request->roomtype,
            ]);
            return redirect()->back()->with(['success' => 'Room Updated Successfully']);
        }
    }


    public function delete(Request $request)
    {
        $room = $this->findOrNot($request->room_id);
        if ($room) {
            $this->delete_from_databse_localStorage($room->images_id);
            $this->decrement_count_room($request->room_type_id);
            return redirect()->back()->with(['delete' => 'Room Deleted successfully']);
        }
    }

    public function change_status_room(Request $request)
    {
        $room = $this->findOrNot($request->room_id);
        if ($room) {
            $room->update([
                'status' =>  $request->payment_status,
            ]);

            return redirect()->back()->with(['success' => 'Status Changed Successfully']);
        }
    }
























    private function all_info_about_room()
    {

        return Room::with(['roomtype' => function ($q) {
            return $q->select('id', 'type', 'description', 'price');
        }])->with(['room_image' => function ($q) {
            return $q->select('id', 'filenames');
        }])->get();
    }

    private function rules()
    {
        return [
            'images' => 'required|max:3',
            'images.*' => 'mimes:png,jpg,jpeg',
            'roomtype' => 'required'
        ];
    }


    private function generation_file_name($images)
    {
        $files = [];
        $count = 0;
        foreach ($images as $image) {
            $file_ex = $image->getClientOriginalExtension();
            $this->random[] = time() . rand(1, 100000);
            $file_name = $count . $this->random[$count] . '.' . $file_ex;
            $count++;
            $files[] = $file_name;
        }
        return $files;
    }


    private function store_room_image_and_save_latest_id($files)
    {
        RoomImage::create([
            'filenames' => $files,
        ]);
        return RoomImage::latest()->first()->id;
    }

    private function store_room($type, $id)
    {
        Room::create([
            'type_id' => $type,
            'images_id' => $id
        ]);
    }

    private function generation_path_image()
    {
        $room_id = Room::latest()->first()->id;
        return self::PATH_IMAGE . $room_id . '/';
    }


    private function save_image_in_local_storage($images, $path)
    {
        $count_image = 0;
        foreach ($images as $image) {
            $file_ex = $image->getClientOriginalExtension();
            $file_name = $count_image . $this->random[$count_image] . '.' . $file_ex;
            $image->move(public_path($path), $file_name);
            $count_image++;
        }
    }



    private function findOrNot($id)
    {
        $room = Room::find($id);
        if ($room) {
            return $room;
        } else {
            return false;
        }
    }

    private function delete_from_databse_localStorage($image_id)
    {
        Storage::disk('rooms')->deleteDirectory($image_id);
        $images_room = RoomImage::find($image_id);
        $images_room->delete();
    }

    private function increment_count_room($room_type_id)
    {
        $info_room_type = Roomtype::find($room_type_id);
        $info_room_type->update([
            'count_room' => $info_room_type->count_room++,
        ]);
    }

    private function decrement_count_room($room_type_id)
    {
        $info_room_type = Roomtype::find($room_type_id);
        $info_room_type->update([
            'count_room' => $info_room_type->count_room--,
        ]);
    }
}
