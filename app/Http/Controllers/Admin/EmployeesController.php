<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employees;
use App\Models\JobDescription;
use Illuminate\Http\Request;
use com;
use Illuminate\Queue\Jobs\RedisJob;
use Illuminate\Support\Facades\Storage;
use PDO;
use phpDocumentor\Reflection\Types\Self_;

class EmployeesController extends Controller
{

    const PATH = 'images\employee\\';
    const RECEPTIONIST = 1;
    const ROOM_ATTENDANT = 2;
    const DOORMAN = 3;
    const POTER = 4;
    const CHEFS = 5;

    public function index()
    {
        $allemployees =  Employees::with('job_des')->get();
        return view('admin.employees.all', compact('allemployees'));
    }

    public function receptionist()
    {
        $allemployees =  Employees::with('job_des')->where('job_id',Self::RECEPTIONIST)->get();
        return view('admin.employees.receptionist', compact('allemployees'));
    }

    public function room_attendant()
    {
        $allemployees =  Employees::with('job_des')->where('job_id',Self::ROOM_ATTENDANT)->get();
        return view('admin.employees.room_attendant', compact('allemployees'));
    }


    public function doorman()
    {
        $allemployees =  Employees::with('job_des')->where('job_id',Self::DOORMAN)->get();
        return view('admin.employees.doorman', compact('allemployees'));
    }

    public function poter()
    {
        $allemployees =  Employees::with('job_des')->where('job_id',Self::POTER)->get();
        return view('admin.employees.poter', compact('allemployees'));
    }

    public function chefs()
    {
        $allemployees =  Employees::with('job_des')->where('job_id',Self::CHEFS)->get();
        return view('admin.employees.chef', compact('allemployees'));
    }

    public function add()
    {
        $jobs =  JobDescription::all();
        return view('admin.employees.add', compact('jobs'));
    }

    public function store(Request $request)
    {
        // validate data
        $request->validate($this->rules(), $this->messages());
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


    public function delete(Request $request)
    {
        $employee  =  $this->findOrNot($request->employee_id);
        if ($employee) {
            Storage::disk('employess')->deleteDirectory($request->employee_id);
            $employee->delete();
            return redirect()->back()->with([
                'delete' => 'Employee deleted successfully'
            ]);
        }
    }

    public function edit($id)
    {
        $jobs =  JobDescription::all();
        $employee = $this->findOrNot($id);
        return view('admin.employees.update', compact('jobs', 'employee'));
    }

    public function update(Request $request)
    {
        // validate data
        $request->validate($this->rules_update($request->id),$this->messages());

        $employee = $this->findOrNot($request->id);
        if ($employee) {
            if ($this->checkImageOrNot($request->pic)) {
                $file_name = $this->generationFileName($request->pic);

                $employee->update([
                    'job_id' => $request->job,
                    'fname' => $request->fname,
                    'lname' => $request->lname,
                    'contact_address' => $request->address,
                    'salay' => $request->salay,
                    'image' => $file_name,
                ]);

                // delete old image
                Storage::disk('employess')->delete($request->id.'\\'.$request->old_image);

                // add new image in localStorage
                $path = self::PATH . $request->id . '\\';
                $request->pic->move(public_path($path),$file_name);

            } else {
                $employee->update([
                    'job_id' => $request->job,
                    'fname' => $request->fname,
                    'lname' => $request->lname,
                    'contact_address' => $request->address,
                    'salay' => $request->salay,
                ]);
            }
            return redirect()->back()->with(['success' => 'Employee Update successfully']);
        }
    }

    private function rules()
    {
        return [
            'fname' => 'required|unique:employees,fname',
            'lname' => 'required',
            'job' => 'required',
            'salay' => 'required|numeric|max:10000',
            'address' => 'required',
            'image' => 'mimes:jpg,png'
        ];
    }

    private function rules_update($id)
    {
        return [
            'fname' => 'required|unique:employees,fname,'.$id,
            'lname' => 'required',
            'job' => 'required',
            'salay' => 'required|numeric|max:10000',
            'address' => 'required',
            'image' => 'mimes:jpg,png'
        ];
    }


    private function messages()
    {
        return [
            'image.mimes' => 'must upload only image',
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

    private function findOrNot($id)
    {
        $employee = Employees::find($id);
        if ($employee) {
            return $employee;
        } else {
            return false;
        }
    }

    private function checkImageOrNot($image)
    {
        return $image ? true : false;
    }
}
