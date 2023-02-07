<?php

namespace App\Http\Controllers\admin;

use App\Models\Attendence;
use App\Models\Leave;
use App\Models\Overtime;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OvertimeController extends \App\Http\Controllers\Controller
{
    public function index(){
        return view('admin.overtime.index' , [
            'requests' => Overtime::where('status' , 'pending')->get(),
            'this_month_overtime' => Overtime::where('status' , 'approved')->whereMonth('created_at' , now()->month)->get(),
            'today_overtime' => Overtime::where('status' , 'approved')->whereDate('created_at' , now())->get(),
        ]);
    }


    public function my_overtime(){
        return view('admin.overtime.my_overtime' , ['overtimes' => Auth::user()->overtimes()->get()]);
    }

   public function my_overtime_add(){
        return view('admin.overtime.my_overtime_add');
    }


    public function create(){
        return view('admin.overtime.create' , ['employees' => User::all()]);
    }


    public function store(){
        $validated = $this->validateOvertime();
        $overtime = new Overtime($validated);
        $overtime->status = 'approved';
        $overtime->save();

        if (url()->previous() == 'http://127.0.0.1:8000/admin/dashboard/overtime/my_overtime_add'){
            if (User::find($validated['user_id'])->overtimes()->whereDate('created_at' , now())->get()){
                return redirect(route('admin.overtime.my_overtime'));
            }
            return redirect(route('admin.overtime.my_overtime_add'))->with(['overtime_error' => 'you already has overtime today']);

        }

        if (!User::find($validated['user_id'])->overtimes()->whereDate('created_at' , now())->get()->isEmpty()){
            return redirect(route('admin.overtime.create'))->with(['overtime_error' => 'this employee already has overtime today']);
        }
        return redirect(route('admin.overtime.index'));
    }


    public function search(){
        if (url()->previous() == 'http://127.0.0.1:8000/admin/dashboard/overtime/my_overtime'){
            $employee = Auth::user();
            return redirect(route('admin.overtime.my_overtime'))->with([
                'search' => $employee->overtimes()->whereMonth('created_at' , request('month'))->get(),
            ]);
        }

        if(request('month') != null && request('status') == null){
            return redirect(route('admin.overtime.index'))->with([
                'search' => Overtime::whereMonth('created_at' , request('month'))->get(),
            ]);
        }
        else if(request('month') == null && request('status') != null){
            return redirect(route('admin.overtime.index'))->with([
                'search' => Overtime::where('status' , request('status'))->get(),
            ]);
        }
        else{
            return redirect(route('admin.overtime.index'))->with([
                'search' => Overtime::whereMonth('created_at' , request('month'))->where('status' , request('status'))->get(),
            ]);
        }

    }


    public function approve($overtime_id){
        $validated = $this->validateOvertimeStatus();
        $overtime = Overtime::find($overtime_id);

        if ($validated['status'] == 'approved') {
            $overtime->status = 'approved';
            $overtime->save();
        }

        if ($validated['status'] == 'declined') {
            $overtime->delete();
        }
        return redirect(route('admin.overtime.index'));
    }


//    public function edit($id){
//        return view('admin.overtime.edit' , ['overtime' => Overtime::find($id)]);
//    }
//
//
//    public function update($id){
//        $overtime = Overtime::find($id);
//        $overtime->update($this->validateEditedOvertime());
//
//        return redirect(route('admin.overtime.index'));
//    }


    public function delete(){
        $overtime = Overtime::find(request('overtime_id'));
        $overtime->delete();

        if (url()->previous() == 'http://127.0.0.1:8000/admin/dashboard/overtime/my_overtime'){
            return redirect(route('admin.overtime.my_overtime'));
        }

        return redirect(route('admin.overtime.index'));
    }


    public function validateEditedOvertime(){
        return  request()->validate([
           'hours' => ['required' , 'numeric' , 'max:10'],
        ]);
    }


    public function validateOvertime(){
        return  request()->validate([
           'user_id' => ['required' , 'exists:users,id'],
           'hours' => ['required' , 'numeric' , 'max:10'],
        ]);
    }


    public function validateOvertimeStatus(){
        return  request()->validate([
            'status' => 'in:pending,approved,declined'
        ]);
    }
}
