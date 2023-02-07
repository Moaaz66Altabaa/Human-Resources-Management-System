<?php

namespace App\Http\Controllers\admin;

use App\Models\Attendence;
use App\Models\Company;
use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends \App\Http\Controllers\Controller
{
    public function index(){
        return view('admin.attendance.index' , [ 'employees' => User::all() ]);
    }


    public function show($attendance_id , $employee_id){
        return view('admin.attendance.show' , [
            'employee' => User::find($employee_id),
            'attendances' => User::find($employee_id)->attendence()->get(),
            'attendance_id' => $attendance_id,
            ]);
    }


    public function my_attendance(){
        return view('admin.attendance.my_attendance' , ['attendances' => Auth::user()->attendence()->get()]);
    }


    public function create(){
        return view('admin.attendance.create' , ['employees' => User::all()]);
    }


    public function search(){
        if (url()->previous() == 'http://127.0.0.1:8000/admin/dashboard/attendance/my_attendance'){
            $employee = Auth::user();
            return redirect(route('admin.attendance.my_attendance'))->with([
                'search_month' => $employee->attendence()->whereMonth('created_at' , request('month'))->get(),
            ]);
        }


        $employees = User::where('first_name' , request('employee_name'))->get();
        if(request('month') != null && request('employee_name') == null){
            return redirect(route('admin.attendance.index'))->with([
                'search_month' => request('month'),
                'employees' => User::all(),
            ]);
        }
        else if(request('month') == null && request('employee_name') != null){
            return redirect(route('admin.attendance.index'))->with([
                'search_employee' => $employees,
            ]);
        }
        else{
            return redirect(route('admin.attendance.index'))->with([
                'search_employee_month' => $employees,
                'month' => request('month'),
            ]);
        }

    }


    public function store(){
        $validated = $this->ValidateAttendance();
        $id = $validated['user_id'];
         if(Attendence::where('user_id' , $id)->whereDay('created_at' , now()->day)->get()->isEmpty()){
            $a = new Attendence($validated);
            $a->save();
            return redirect(route('admin.attendance.index'));
         }
        return redirect(route('admin.attendance.create'));
    }


    public function edit($id){
        return view('admin.salaries.edit' , ['salary' => Salary::find($id)]);
    }


    public function update($id){
        $salary = Salary::find($id);
        $salary->update($this->ValidateUpdatedSalary());
        return redirect(route('admin.salaries.show' , $salary->id));
    }


    public function ValidateAttendance(){
        $start_time = Company::all()->firstOrFail()->start_time;
        return request()->validate([
            'user_id' => ['required' , 'exists:users,id'],
            'status' => ['required' , 'string' , 'in:present,absent,on_vacation' ],
            'check_in' => ['required' , 'after:$start_time' ],
            'check_out' => ['required' , 'after:check_in' ],
        ]);
    }

}
