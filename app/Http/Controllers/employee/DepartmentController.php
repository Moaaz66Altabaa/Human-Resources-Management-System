<?php

namespace App\Http\Controllers\employee;

use Illuminate\Http\Request;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
class DepartmentController extends \App\Http\Controllers\Controller
{
   

    public function index(){
        
        return view('employee.departments.index' , [ 'departments' => Department::all()]);
    }


    // public function show($id){
    //     return view('employee.departments.show' , ['department' => Department::find($id)]);
    // }


}
