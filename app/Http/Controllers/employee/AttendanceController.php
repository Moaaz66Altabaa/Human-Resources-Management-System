<?php

namespace App\Http\Controllers\employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendence;
use App\Models\Overtime;
use Carbon\Carbon;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
class AttendanceController extends Controller
{

    public function my_attendance(){
        return view('employee.attendance.myattendance',[
            'attendances'=> Auth::user()->attendence
        ]);
    }

    public function overtime(){
        return view('employee.attendance.overtime',[
            "overtimes" => Auth::user()->overtimes
        ]);
    }

    public function add_overtime(){
        return view('employee.attendance.add-overtime');
            
        
    }

    public function store(){
        $overtime = new Overtime($this->ValidateOvertime());
        $overtime->user_id= Auth::user()->id;
        $overtime->status= 'pending';
        $overtime->save();
        return redirect(route('employee.attendance.overtime'));
    }

    public function ValidateOvertime(){
        return request()->validate([

            'hours' => ['required','string' ]
        ]);
    }
    
    public function edit_overtime($id){
       
        return view('employee.attendance.edit-overtime',['overtime'=>Overtime::find($id)] );
    }


    public function update_overtime($id){
        $overtime = Overtime::find($id);
        if($overtime->status=='pending'){
        $overtime->update($this->ValidateEditedOvertime());}
        return redirect(route('employee.attendance.overtime'));
    
    }

    public function ValidateEditedOvertime(){
        return request()->validate([
            'hours' => ['required','string']
        ]);
    }
   public function search(){
    return redirect(route('employee.attendance.my_attendance'))->with([
        'search' => Auth::user()->attendence()->whereMonth('created_at' , request('month'))->get(),
    ]);
   }

    // public function check_in(){
    //     $user=Auth::user();
    //     $a = Attendence::where('user_id' , $user->id)->whereDate('created_at' , now())->first();

    //     if($a->check_in == null){
    //         $a->check_in = now();
    //         $a->status = 'present';
    //         $a->save();

    //         return redirect(route('employee.attendance.index'));
    //     }

    //     if($a->check_out == null && $a->check_in != null){
    //         $a->check_out = now();
    //         $check_in = Carbon::parse($a->check_in);
    //         $check_out = Carbon::parse($a->check_out);
    //         $finsh_time= Carbon::parse(Company::first()->finish_time);

    //         if($check_out->lte($finsh_time) ){
    //             $user->hours_per_month = $user->hours_per_month + $check_in->diff($check_out)->h + $check_in->diff($check_out)->i/60;
    //             $user->save();
    //         }
    //         else{
    //             $user->hours_per_month =$user->hours_per_month + $check_in->diff($finsh_time)->h + $check_in->diff($finsh_time)->i/60;
    //             $user->save();

    //             if($overtime = Overtime::where('user_id' , $user->id)->whereDate('created_at' , now())->first()){

    //                 if($check_out->diff($finsh_time)->h + $check_out->diff($finsh_time)->i/60 <= ($overtime->hours)){
    //                     $user->overtime_hours = $user->overtime_hours + $check_out->diff($finsh_time)->h +  $check_out->diff($finsh_time)->i/60;
    //                     $user->save();
    //                     $a->overtime = $check_out->diff($finsh_time)->h +  $check_out->diff($finsh_time)->i/60;
    //                     $a->save();
    //                 }
    //                 else{
    //                     $user->overtime_hours = $user->overtime_hours + $overtime->hours;
    //                     $user->save();
    //                     $a->overtime = $overtime->hours;
    //                     $a->save();

    //                 }

    //             }
    //         }

    //     }
    //     return redirect(route('employee.attendance.index'));
    // }

    public function delete(){
        $overtime = Overtime::find(request('overtime_id'));
        $overtime->delete();
        return redirect(route('employee.attendance.overtime'));

    }


   
}
