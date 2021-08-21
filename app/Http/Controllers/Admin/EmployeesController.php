<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employees;
use App\Models\JobDescription;
use Illuminate\Http\Request;
use com;

class EmployeesController extends Controller
{

    const PATH = 'images\employee\\';

    public function index()
    {
        $allemployees =  Employees::with('job_des')->get();

        return view('admin.employees.all', compact('allemployees'));
    }

    public function add()
    {
        $jobs =  JobDescription::all();
        return view('admin.employees.add', compact('jobs'));
    }

    public function store(Request $request)
    {
        // validate data
        $request->validate($this->rules());
        $file_name = $this->generationFileName($request->pic);
        Employees::create([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'job_id' => $request->job,
            'salay' => $request->salay,
            'contact_address' => $request->address,
            'image' => $file_name
        ]);
        $this->savaImageInLocal($request->pic, $file_name);
        return redirect()->back()->with(['success' => 'Employee Added successfully']);
    }

    private function rules()
    {
        return [
            'fname' => 'required|unique:employees,fname',
            'lname' => 'required',
            'job' => 'required',
            'salay' => 'required|numeric|max:10000',
            'address' => 'required',
        ];
    }

    private function savaImageInLocal($image, $file_name)
    {

        $id = Employees::latest()->first()->id;
        $path = self::PATH . $id . '\\';
        $image->move(public_path($path), $file_name);
    }

    private function generationFileName($image)
    {
        $file_ex = $image->getClientOriginalExtension();
        return time() . '.' . $file_ex;
    }
}
