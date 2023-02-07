<?php

namespace App\Http\Controllers\admin;

use App\Models\Company;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CompanyController extends \App\Http\Controllers\Controller
{
    public function index(){
        return view('admin.company.index' , [ 'company' => Company::firstOrfail() ]);
    }


    public function update(){
        $validated = $this->ValidateCompany();
//        $start_time = date_create_from_format('H:i:s' , $validated['start_time']);
//        $finish_time = date_create_from_format('H:i:s' , $validated['finish_time']);
//        dd($start_time->diff($finish_time)->h);

        $company = Company::first();
        $company->update($this->ValidateCompany());

        return redirect(route('admin.company.index'));
    }


    public function ValidateCompany(){
        return request()->validate([
            'name' => ['required' , 'max:30'],
            'tel_number' => ['required' , 'string' , 'max:10'],
            'address' => ['required' , 'string'],
            'description' => ['required' , 'string'],
            'start_time' => ['required' ],
            'finish_time' => ['required' , 'after:start_time'],
        ]);
    }
}
