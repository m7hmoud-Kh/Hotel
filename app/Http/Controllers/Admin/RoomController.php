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



    // i can't do validate for this image in laravel 8
    public function store(Request $request)
    {
        // $request->validate([
        //     'roomtype' => 'required',
        //     'images' => 'required',
        // ]);

        // $allowedfileExtension = ['jpeg', 'jpg', 'png'];

        // $files = [];
        // if ($request->hasfile('images')) {
        //     $images = $request->file('images');
        //     foreach ($images as $image) {
        //         // Getting image extension
        //         $extension = $image->getClientOriginalExtension();
        //         $check = in_array($extension, $allowedfileExtension);
        //         // Checking the image extension
        //         if (!$check) {
        //             return redirect()->back()->with('extension', 'Images must be png, jpeg or jpg!');
        //         }
        //         // ...
        //     }
        // }else
        // {
        //     return 'helo';
        // }
    }


}
