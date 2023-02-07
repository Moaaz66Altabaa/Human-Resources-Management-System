<?php

namespace App\Http\Controllers\admin;

use App\Models\Department;
use App\Models\Job;
use App\Models\Overtime;
use App\Models\Salary;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SalaryController extends \App\Http\Controllers\Controller
{
    public function index(){
        return view('admin.salaries.index' , [
            'salaries' => Salary::all(),
            'departments' => Department::all(),
            ]);
    }


//    public function show($id){
//        return view('admin.salaries.show' , ['salary' => Salary::find($id)]);
//    }


    public function my_salary(){
        return view('admin.salaries.my_salary' , ['employee' => Auth::user()]);
    }


    public function create(){
        return view('admin.salaries.create' , ['employees' => User::all()]);
    }


    public function store(){
        $validated = $this->ValidateSalary();
        $id = $validated['user_id'];
        if (!User::find($id)->salary){
        $salary = new Salary($validated);
        $salary->total = $validated['net']*30 + $validated['hra'] + $validated['conveyance'] + $validated['fa'] + $validated['la'] ;
        $salary->save();

        }
        else{
            return redirect(route('admin.salaries.create'))->with(['user_error' => 'this employee already has a salary']);
        }
        return redirect(route('admin.salaries.index'));
    }


    public function delete(){
        $salary = Salary::find(request('salary_id'));
        $salary->delete();

        if (url()->previous() == 'http://127.0.0.1:8000/admin/dashboard/salaries/my_salary'){
            return redirect(route('admin.salaries.my_salary'));
        }

        return redirect(route('admin.salaries.index'));
    }


    public function edit($id){
        return view('admin.salaries.edit' , ['salary' => Salary::find($id)]);
    }


    public function update($id){
        $salary = Salary::find($id);
        $validated = $this->ValidateUpdatedSalary();
        $salary->update($validated);
        $salary->total = $validated['net']*30 + $validated['hra'] + $validated['conveyance'] + $validated['fa'] + $validated['la'] ;
        $salary->save();

        if (url()->previous() == 'http://127.0.0.1:8000/admin/dashboard/salaries/my_salary_edit'){
            return redirect(route('admin.salaries.my_salary'));
        }

        return redirect(route('admin.salaries.index'));
    }


    public function search(){
        if (url()->previous() == 'http://127.0.0.1:8000/admin/dashboard/salaries/my_salary'){
            $employee = Auth::user();
            return redirect(route('admin.overtime.my_overtime'))->with([
                'search' => $employee->overtimes()->whereMonth('created_at' , request('month'))->get(),
            ]);
        }

        if(request('department_id') != null && request('employee_name') == null){
            return redirect(route('admin.salaries.index'))->with([
                'search_return_jobs' => Job::where('department_id' , request('department_id'))->get(),
            ]);
        }
        else if(request('department_id') == null && request('employee_name') != null){
            return redirect(route('admin.salaries.index'))->with([
                'search_return_employees' => User::where('first_name' , request('employee_name'))->get(),
            ]);
        }
        else{
            return redirect(route('admin.salaries.index'))->with([
                'name' => request('employee_name'),
                'jobs' => Job::where('department_id' , request('department_id'))->get(),

            ]);
        }

    }

    public function ValidateSalary(){

        return request()->validate([
            'net' => ['required' , 'numeric'],
            'user_id' => ['required' , 'exists:users,id'],
            'overtime' => ['required' , 'numeric' ],
            'hra' => ['required' , 'numeric' ],
            'conveyance' => ['required' , 'numeric' ],
            'fa' => ['required' , 'numeric' ],
            'la' => ['required' , 'numeric' ],
        ]);
    }

    public function ValidateUpdatedSalary(){

        return request()->validate([
            'net' => ['required' , 'numeric'],
            'overtime' => ['required' , 'numeric' ],
            'hra' => ['required' , 'numeric' ],
            'conveyance' => ['required' , 'numeric' ],
            'fa' => ['required' , 'numeric' ],
            'la' => ['required' , 'numeric' ],
        ]);
    }


}
