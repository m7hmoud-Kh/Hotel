<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ClientController extends Controller
{

    public function all()
    {
        $all_client = User::orderby('status','desc')->get();
        return view('admin.client.all',compact('all_client'));
    }

    public function delete(Request $request)
    {
        $client = User::find($request->client_id);
        if($client)
        {
            $client->delete();
            return redirect()->back()->with(['delete'=>'Client Deleted Successfully']);
        }
    }
}
