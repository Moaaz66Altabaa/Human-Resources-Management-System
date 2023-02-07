<?php

namespace App\Http\Controllers\employee;

use App\Models\Leave;
use App\Models\User;
use App\Notifications\AddLeaveNotification;
use App\Notifications\ApprovedLeaveNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;


class LeaveController extends \App\Http\Controllers\Controller
{
    public function index(){
        return view('employee.leaves.index',[
            'leaves'=> Leave::all()
        ]);
    }

    public function myleaves(){
        $total = 0;
        $un_paid=0;
        $paid=0;
        $user=Auth::user();
        foreach(Leave::all() as $leave){
            $total = $leave->max_per_month + $total;}

        foreach(Auth::user()->leaves()->where('is_paid','0')->get() as $leave){
            $un_paid =  $leave->pivot->days + $un_paid;
        }

        foreach(Auth::user()->leaves()->where('is_paid','1')->get() as $leave){
            $paid =  $leave->pivot->days + $paid;
        }

        return view('employee.leaves.myleaves',
        [   'leaves' => Auth::user()->leaves()->get(),
            'total'  => $total,
            'un_paid' =>$un_paid,
            'paid' =>$paid,
            'remaining' =>$total-($un_paid+$paid),
            'names' =>Leave::all()
        ]);
    }

     public function addleave(){
         return view('employee.leaves.add-myleave' , ['leaves' => Leave::all()]);
     }

    //  public function edit_leave(){
    //     return view('employee.leaves.edit-myleave' , ['leaves' => Leave::all()]);
    // }



    public function storeleave(){
       $validated = $this->ValidateAddedLeave();
        $user = Auth::user();
        $user_leaves = 0;

//       this function convert from string to date
         $from = Carbon::parse($validated['from']);
         $to = Carbon::parse($validated['to']);
//       checks if to is taken before from
         if ($from->gt($to)){
             return redirect(route('employee.leaves.addleave'))->with(['invalid_date_error' => 'you entered an invalid date']);
         }
//       checks if from is today
         if ($from->day ==now()->day){
             return redirect(route('employee.leaves.addleave'))->with(['invalid_date_error' => 'you cannot add leave that starts today']);
         }

 //      checks if from || to has passed
         if ($from->isPast() || $to->isPast()){
             return redirect(route('employee.leaves.addleave'))->with(['invalid_date_error' => 'the date you entered has passed']);
         }

 //      make sure that from && to are in the same month
         if ($from->month != $to->month){
             return redirect(route('employee.leaves.addleave'))->with(['invalid_date_error' => 'leave days must be in the same month ']);
         }

 //      checks if the employee  has no leaves yet
        if($user->leaves()->get()->isEmpty()){
 //            check that the new leave days are <= the max limit of this leave
             if ($from->diff($to)->days +1 <= Leave::find($validated['leave_id'])->max_per_month) {
                 $user->leaves()->attach([$validated['leave_id'] =>
                     ['days'      => $from->diff($to)->days+1,
                         'from'   => $from,
                         'to'     => $to,
                         'status' => 'pending',
                         'reason' =>$validated['reason']

                     ]]);
                 Notification::send(User::where('is_admin' , 1)->get() , new AddLeaveNotification(auth()->user()));

                 return redirect(route('employee.leaves.myleaves'))->with(['add_leave_success' => 'leave has been submitted successfully !']);
             }else{
                 return redirect(route('employee.leaves.addleave'))->with(['add_leave_error' => 'you have crossed the leave days limit']);
             }}

        else{

 //            this loop checks that the new leave does not conflict with another leave
             foreach($user->leaves()->whereMonth('leave_user.from' , $from->month)
                         ->get() as $userleave){
                if ($from == $userleave->pivot->from || $from == $userleave->pivot->to
                     || $from > $userleave->pivot->from && $from < $userleave->pivot->to
                     || $to == $userleave->pivot->from || $to == $userleave->pivot->to
                    || $to > $userleave->pivot->from && $to < $userleave->pivot->to
                     || $from < $userleave->pivot->from && $to > $userleave->pivot->to){
                    return redirect(route('employee.leaves.addleave'))->with(['add_leave_error' => 'this employee has already took a leave on this date']);
                }
          }

 //            this loop counts the days of all leaves that have been taken in this month
            foreach($user->leaves()->where('leave_id' , $validated['leave_id'])
                         ->whereMonth('leave_user.from' , $from->month)
                       ->get() as $userleave){
                 $user_leaves = $user_leaves + $userleave->pivot->days;
            }

 //           checks if new leave + old leaves sum is not over the limit
            if ($user_leaves + $from->diff($to)->days +1 <= Leave::find($validated['leave_id'])->max_per_month) {

                $user->leaves()->attach([$validated['leave_id'] =>
                     ['days'     => $from->diff($to)->days +1 ,
                        'from'   => $from,
                        'to'     => $to,
                        'status' => 'pending',
                        'reason' =>$validated['reason']
                   ]]);
                Notification::send(User::where('is_admin' , 1)->get() , new AddLeaveNotification(auth()->user()));
                return redirect(route('employee.leaves.myleaves'))->with(['add_leave_success' => 'leave has been submitted successfully !']);
            } else {
                return redirect(route('employee.leaves.addleave'))->with(['add_leave_error' => 'this employee has exhausted their leaves']);
            }
        }



}

    public function ValidateAddedLeave(){
        return request()->validate([
            'leave_id' => ['required' , 'exists:leaves,id'],
            'from' => ['required' , 'date'],
            'to' => ['required' , 'date'],
            'reason' => ['required' , 'string' , 'max:300']

        ]);
    }
    public function delete(){
        $leave = DB::table('leave_user')->delete(request('leave_id'));

        return redirect(route('employee.leaves.myleaves'));

    }

}
