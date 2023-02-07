<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Department;

class JobController extends \App\Http\Controllers\Controller
{
    public function index(){
        return view('admin.jobs.index' , [
            'jobs' => Job::all(),
            'departments' => Department::all(),
            ]);
    }


//    public function show($id){
//        return view('admin.jobs.show' , ['job' => Job::find($id)]);
//    }
//
//
    public function create(){
        return view('admin.jobs.create' , ['departments' => Department::all()]);
    }


    public function store(){
        $job = new Job($this->ValidateJob());
        $job->save();
        return redirect(route('admin.jobs.index'));
    }


    public function edit($id){
        return view('admin.jobs.edit' , ['job' => Job::find($id) , 'departments' => Department::all()]);
    }


    public function update($id){
        $job = Job::find($id);
        $job->update($this->ValidateEditedJob());
        return redirect(route('admin.jobs.index' , $job->id));
    }


    public function delete(){
        $job = Job::find(request('job_id'));
        $job->delete();
        return redirect(route('admin.jobs.index'));
    }


    public function ValidateJob(){
        return request()->validate([
            'name' => ['required' , 'unique:jobs,name' , 'max:30'],
            'department_id' => ['required' , 'exists:departments,id']
        ]);
    }

    public function ValidateEditedJob(){
        return request()->validate([
            'name' => ['required' , 'max:30'],
            'department_id' => ['required' , 'exists:departments,id']
        ]);
    }
}
