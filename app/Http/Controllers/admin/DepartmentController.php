<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Department;
use Illuminate\Support\Facades\File;

class DepartmentController extends \App\Http\Controllers\Controller
{
    public function index(){
        return view('admin.departments.index' , [ 'departments' => Department::all() ]);
    }


//    public function show($id){
//        return view('admin.departments.show' , ['department' => Department::find($id)]);
//    }
//
//
    public function create(){
        return view('admin.departments.create');
    }


    public function store(){
        $department = new Department($this->ValidateDepartment());
        $department->save();
        return redirect(route('admin.departments.index'));
    }


    public function edit($id){
        return view('admin.departments.edit' , ['department' => Department::find($id)]);
    }


    public function update($id){
        $department = Department::find($id);
        $department->update($this->ValidateEditedDepartment());
        return redirect(route('admin.departments.index'));
    }


    public function delete(){
        $department = Department::find(request('department_id'));
        $department->delete();
        return redirect(route('admin.departments.index'));
    }


    public function ValidateDepartment(){
        return request()->validate([
            'name' => ['required' , 'unique:departments,name' , 'max:30'],
            'tel_number' => ['required' , 'max:10']
        ]);
    }


    public function ValidateEditedDepartment(){
        return request()->validate([
            'tel_number' => ['required' , 'max:10']
        ]);
    }
}
