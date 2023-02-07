<?php

namespace App\Http\Controllers\employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;
use Illuminate\Support\Facades\Auth;


class JobController extends Controller
{
    //
    public function index(){
        return view('employee.jobs.index' , [ 'jobs' => Job::all() ]);
    }


    // public function show($id){
    //     return view('employee.jobs.show' , ['job' => Job::find($id)]);
    // }
}
