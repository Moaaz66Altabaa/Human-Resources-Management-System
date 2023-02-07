<?php

namespace App\Http\Controllers\admin;

use App\Models\Department;
use App\Models\User;
use App\Models\Job;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class EmployeeController extends \App\Http\Controllers\Controller
{
    public function index(){
        return view('admin.employees.index' , [
            'employees' => User::all(),
            'jobs' => Job::all(),
        ]);
    }


//    public function show($id){
//        return view('admin.employees.show' , ['employee' => User::find($id)]);
//    }
//
//
    public function create(){
        return view('admin.employees.create' , ['jobs' => Job::all()]);
    }


    public function store(){
        $employee = new User($this->CreateEmployee());
        $employee->save();
        return redirect(route('admin.employees.index'));
    }


    public function edit($id){
        return view('admin.employees.edit' , ['employee' => User::find($id) , 'jobs' => Job::all()]);
    }


    public function update($id){
        $employee = User::find($id);
        $employee->update($this->CreateEditedEmployee());
        return redirect(route('admin.employees.index'));
    }


    public function delete(){
        $employee = User::find(request('user_id'));
        File::delete(public_path('images/' . $employee->image_path));
        $employee->delete();
        return redirect(route('admin.employees.index'));
    }


    public function search(){
        $employees = User::where('first_name' , request('employee_name'))->get();
        $job = Job::find(request('job_id'));

        if (request('job_id') == null && request('employee_name') != null) {
            return redirect(route('admin.employees.index'))->with([
                'search' => $employees,
            ]);
        }
        else if(request('job_id') != null && request('employee_name') == null){
            return redirect(route('admin.employees.index'))->with([
                'search' => User::where('job_id' , $job->id)->get(),
            ]);
        }
        else if(request('job_id') != null && request('employee_name') != null){
            return redirect(route('admin.employees.index'))->with([
                'search' => User::where('job_id' , $job->id)->where('first_name' , request('employee_name'))->get(),
            ]);
        }
        else{
            return redirect(route('admin.employees.index'));
        }
    }


    public function ValidateEmployee(){
        return request()->validate([
            'first_name' => ['required' , 'max:20'],
            'last_name' => ['required' , 'max:20'],
            'job_id' => ['required' , 'exists:jobs,id'],
            'mobile_number' => ['required' , 'numeric'],
            'email' => ['required' , 'email' , 'unique:users,email'],
            'password' => ['required' , 'string' , 'min:8' , 'confirmed'],
            'is_admin' => ['required' , 'boolean'],
        ]);
    }

    public function CreateEmployee(){
        $validated = $this->ValidateEmployee();
        $data = [
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'mobile_number' => $validated['mobile_number'],
            'job_id' => $validated['job_id'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'is_admin' => $validated['is_admin'],
        ];

        return $data;
    }

    public function ValidateEditedEmployee(){
        return request()->validate([
            'first_name' => ['required' , 'max:20'],
            'last_name' => ['required' , 'max:20'],
            'job_id' => ['required' , 'exists:jobs,id'],
            'mobile_number' => ['required' , 'numeric'],
            'email' => ['required' , 'email' ],
            'password' => ['required' , 'string' , 'min:8' , 'confirmed'],
            'is_admin' => ['required' , 'boolean']
        ]);
    }

    public function CreateEditedEmployee(){
        $validated = $this->ValidateEditedEmployee();
        $data = [
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'mobile_number' => $validated['mobile_number'],
            'job_id' => $validated['job_id'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'is_admin' => $validated['is_admin']
        ];
        return $data;
    }

}
