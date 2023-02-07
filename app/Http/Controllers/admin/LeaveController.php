<?php

namespace App\Http\Controllers\admin;

use App\Events\ApprovedLeaveEvent;
use App\Models\Job;
use App\Models\Leave;
use App\Models\User;
use App\Notifications\ApprovedLeaveNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Array_;
use phpDocumentor\Reflection\Types\Collection;
use function MongoDB\BSON\fromJSON;


class LeaveController extends \App\Http\Controllers\Controller
{
    public function index(){
        return view('admin.leaves.index' , [
            'leaves' => Leave::all() ,
            'pending_leaves' => DB::table('leave_user')->where('status' , 'pending')->get(),
            'approved_leaves' => DB::table('leave_user')->where('status' , 'approved')
                ->whereDate('from', '<=', now())
                ->whereDate('to', '>=', now())
                ->get(),
            ]);
    }

    public function leave_type(){
        return view('admin.leaves.leave_type' , [ 'leaves' => Leave::all() ]);
    }


    public function my_leaves(){
        $employee = Auth::user();
        $total_leaves = 0;
        foreach (Leave::all() as $leave){
            $total_leaves = $total_leaves + $leave->max_per_month;
        }
        $total_employee_leaves = 0;
        foreach ($employee->leaves()->get() as $leave) {
            $total_employee_leaves = $total_employee_leaves + $leave->pivot->days;
        }

        return view('admin.leaves.my_leaves' , [
            'leaves' => $employee->leaves()->get(),
            'paid_leaves' => $employee->leaves()->where('is_paid' , 1)->get(),
            'unpaid_leaves' => $employee->leaves()->where('is_paid' , 0)->get(),
            'total_leaves' => $total_leaves,
            'remaining_leaves' => ($total_leaves - $total_employee_leaves),

            ]);
    }

    public function leave_settings(){
        return view('admin.leaves.leave_settings' , ['leaves' => Leave::all()]);
    }


    public function my_leaves_addleave(){
        return view('admin.leaves.my_leaves_addleave' , ['leaves' => Leave::all()]);
    }


    public function my_leaves_storeleave(){
        $validated = $this->ValidateAddedLeave();
        $user = User::find($validated['user_id']);
        $user_leaves = 0;
//        this function convert from string to date
        $from = Carbon::parse($validated['from']);
        $to = Carbon::parse($validated['to']);

//        checks if to is taken before from
        if ($from->gt($to)){
            return redirect(route('admin.leaves.my_leaves_addleave'))->with(['invalid_date_error' => 'you entered an invalid date']);
        }

//        checks if from is today
        if ($from->day ==now()->day){
            return redirect(route('admin.leaves.my_leaves_addleave'))->with(['invalid_date_error' => 'you cannot add leave that starts today']);
        }

//        checks if from || to has passed
        if ($from->isPast() || $to->isPast()){
            return redirect(route('admin.leaves.my_leaves_addleave'))->with(['invalid_date_error' => 'the date you entered has passed']);
        }

//        make sure that from && to are in the same month
        if ($from->month != $to->month){
            return redirect(route('admin.leaves.my_leaves_addleave'))->with(['invalid_date_error' => 'leave days must be in the same month ']);
        }

//        checks if the employee  has no leaves yet
        if($user->leaves()->get()->isEmpty()){
//            check that the new leave days are <= the max limit of this leave
            if ($from->diff($to)->days +1 <= Leave::find($validated['leave_id'])->max_per_month) {
                $user->leaves()->attach([$validated['leave_id'] =>
                    ['days' => $from->diff($to)->days+1,
                        'from' => $from,
                        'to' => $to,
                        'status' => 'approved',
                        'reason' => $validated['reason'],
                    ]]);
                return redirect(route('admin.leaves.my_leaves'))->with(['add_leave_success' => 'leave has been added successfully !']);
            }else{
                return redirect(route('admin.leaves.my_leaves_addleave'))->with(['add_leave_error' => 'you have crossed the leave days limit']);
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
                    return redirect(route('admin.leaves.my_leaves_addleave'))->with(['add_leave_error' => 'you have already took a leave on this date']);
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
                    ['days' => $from->diff($to)->days +1 ,
                        'from' => $from,
                        'to' => $to,
                        'status' => 'approved',
                        'reason' => $validated['reason'],

                    ]]);

                return redirect(route('admin.leaves.my_leaves'))->with(['add_leave_success' => 'leave has been added successfully !']);
            } else {
                return redirect(route('admin.leaves.my_leaves_addleave'))->with(['add_leave_error' => 'you have exhausted your leaves']);
            }
        }
    }


//    public function show($id){
//        return view('admin.leaves.show' , ['leave' => Leave::find($id)]);
//    }
//
//
    public function create(){
        return view('admin.leaves.create');
    }


    public function search(){
//        if (request('employee_name') != null && request('leave_name') != null && request('status') != null){
//            return $this->search_employee_leave_status_name();
//        }
//
//        else if (request('employee_name') != null && request('leave_name') != null && request('status') == null){
//            return $this->search_employee_leave_name();
//        }
//
        if (request('employee_name') != null && request('leave_name') == null && request('status') == null){
            return $this->search_employee_name();
        }

        else if (request('employee_name') == null && request('leave_name') != null && request('status') == null){
            return $this->search_leave_type();
        }

        else if (request('employee_name') == null && request('leave_name') == null && request('status') != null){
            return $this->search_status();
        }
        else{
            return redirect(route('admin.leaves.index'));
        }

    }


//    public function search_employee_leave_status_name(){
//        $employees_ids = [];
//        foreach (User::where('first_name' , request('employee_name'))->get() as $employee) {
//           Arr::add($employees_ids , $employee->id , $employee->id);
//        }
//        $leave = Leave::where('name' , request('leave_name'))->first();
//
//        return redirect(route('admin.leaves.index'))->with([
//            'search_return_leaves' => DB::table('leave_user')->where('leave_id' , $leave->id)->whereRowValues(['user_id'] , '=' , $employees_ids)->get()
//        ]);
//    }


//    public function search_employee_leave_name(){
//        $employees = User::where('first_name' , request('employee_name'))->get();
//        $leave = Leave::where('name' , request('leave_name'))->first();
//        $a = collect();
//        foreach ($employees as $employee){
//            $a->push($employee->leaves()->where('name' , request('leave_name'))->get());
//        }
//        return redirect(route('admin.leaves.index'))->with([
//            'search_return_leaves_pivot' => $a,
//
//        ]);
//    }


    public function search_employee_name(){
        $employees = User::where('first_name' , request('employee_name'))->get();

        return redirect(route('admin.leaves.index'))->with(['search_return_employees' => $employees]);

    }


    public function search_leave_type(){
        $leave = Leave::where('name' , request('leave_name'))->first();
        if ($leave) {
            return redirect(route('admin.leaves.index'))->with([
                'search_return_leaves' => DB::table('leave_user')->where('leave_id' , $leave->id)->get(),
            ]);
        }
        return redirect(route('admin.leaves.index'));
    }


    public function search_status(){
        $leaves = DB::table('leave_user')->where('status' , request('status'))->get();
        if ($leaves) {
            return redirect(route('admin.leaves.index'))->with([
                'search_return_leaves' => $leaves,
            ]);
        }
        return redirect(route('admin.leaves.index'));
    }


    public function store(){
        $leave = new Leave($this->ValidateLeave());
        $leave->save();
        return redirect(route('admin.leaves.leave_type'));
    }


    public function edit($id){
        return view('admin.leaves.edit' , ['leave' => Leave::find($id)]);
    }


    public function updateLeaveSettings($id){
        $leave = Leave::find($id);
        $leave->update($this->ValidateEditedLeaveSettings());
        return redirect(route('admin.leaves.leave_settings'));
    }

    public function update($id){
        $leave = Leave::find($id);
        $leave->update(request()->validate(['name' => ['required' , 'unique:leaves,name' , 'max:30']]));
        return redirect(route('admin.leaves.leave_type'));
    }


    public function delete(){
        $leave = Leave::find(request('leave_id'));
        $leave->delete();
        return redirect(route('admin.leaves.leave_type'));
    }


    public function deleteleave(){
        $leave = DB::table('leave_user')->delete(request('leave_id'));

        if (url()->previous() == 'http://127.0.0.1:8000/admin/dashboard/leaves/my_leaves'){
            return redirect(route('admin.leaves.my_leaves'));
        }
        return redirect(route('admin.leaves.index'));
    }


    public function approve($leave_id){
        $validated = $this->validateLeaveStatus();

        $user = User::find(DB::table('leave_user')->find($leave_id)->user_id);

        if ($validated['status'] == 'approved') {
            DB::update('update leave_user set status = ? where id  = ?' , [ $validated['status'] , $leave_id ]);
            Notification::send($user , new ApprovedLeaveNotification($user));
        }

        if ($validated['status'] == 'declined') {
            DB::delete('delete from leave_user where id = ? ' , [ $leave_id ]);
//            Notification::send($user, new ApprovedLeaveNotification());
        }

        return redirect(route('admin.leaves.index'));
    }


    public function addleave(){
        return view('admin.leaves.addleave' , ['leaves' => Leave::all() , 'employees' => User::all()]);
    }


    public function storeleave(){
        $validated = $this->ValidateAddedLeave();
        $user = User::find($validated['user_id']);
        $user_leaves = 0;
//        this function convert from string to date
        $from = Carbon::parse($validated['from']);
        $to = Carbon::parse($validated['to']);

//        checks if to is taken before from
        if ($from->gt($to)){
            return redirect(route('admin.leaves.addleave'))->with(['invalid_date_error' => 'you entered an invalid date']);
        }

//        checks if from is today
        if ($from->day ==now()->day){
            return redirect(route('admin.leaves.addleave'))->with(['invalid_date_error' => 'you cannot add leave that starts today']);
        }

//        checks if from || to has passed
        if ($from->isPast() || $to->isPast()){
            return redirect(route('admin.leaves.addleave'))->with(['invalid_date_error' => 'the date you entered has passed']);
        }

//        make sure that from && to are in the same month
        if ($from->month != $to->month){
            return redirect(route('admin.leaves.addleave'))->with(['invalid_date_error' => 'leave days must be in the same month ']);
        }

//        checks if the employee  has no leaves yet
        if($user->leaves()->get()->isEmpty()){
//            check that the new leave days are <= the max limit of this leave
            if ($from->diff($to)->days +1 <= Leave::find($validated['leave_id'])->max_per_month) {
                $user->leaves()->attach([$validated['leave_id'] =>
                    ['days' => $from->diff($to)->days+1,
                        'from' => $from,
                        'to' => $to,
                        'status' => 'approved',
                        'reason' => $validated['reason'],

                    ]]);
                return redirect(route('admin.leaves.index'))->with(['add_leave_success' => 'leave has been added successfully !']);
        }else{
                return redirect(route('admin.leaves.addleave'))->with(['add_leave_error' => 'you have crossed the leave days limit']);
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
                    return redirect(route('admin.leaves.addleave'))->with(['add_leave_error' => 'this employee has already took a leave on this date']);
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
                        ['days' => $from->diff($to)->days +1 ,
                            'from' => $from,
                            'to' => $to,
                            'status' => 'approved',
                            'reason' => $validated['reason'],

                        ]]);

                    return redirect(route('admin.leaves.index'))->with(['add_leave_success' => 'leave has been added successfully !']);
                } else {
                    return redirect(route('admin.leaves.addleave'))->with(['add_leave_error' => 'this employee has exhausted their leaves']);
                }
        }
    }


    public function ValidateLeave(){
        return request()->validate([
            'name' => ['required' , 'unique:leaves,name' , 'max:30'],
            'is_paid' => ['required' , 'boolean'],
            'max_per_month' => ['required' , 'numeric' , 'max:26']
        ]);
    }


    public function ValidateEditedLeaveSettings(){
        return request()->validate([
            'is_paid' => ['required' , 'boolean'],
            'max_per_month' => ['required' , 'numeric' , 'max:26']
        ]);
    }


    public function ValidateAddedLeave(){
        return request()->validate([
            'user_id' => ['required' , 'exists:users,id'],
            'leave_id' => ['required' , 'exists:leaves,id'],
            'from' => ['required' , 'date'],
            'to' => ['required' , 'date'],
            'reason' => ['required' , 'string' , 'max:300']
        ]);
    }


    public function validateLeaveStatus(){
        return request()->validate([
            'status' => 'in:pending,approved,declined'
        ]);
    }
}
