<?php

namespace App\Http\Controllers\employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;


class CompanyController extends Controller
{
    //
    public function index(){
        return view('employee.company.index' , [ 'company' => Company::firstOrfail() ]);
       
    }
}
