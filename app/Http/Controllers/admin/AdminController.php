<?php

namespace App\Http\Controllers\admin;

use App\Models\Attendence;
use App\Models\Company;
use App\Models\Department;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Holiday;
use App\Models\Job;
use App\Models\Leave;
use App\Models\Overtime;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use function Symfony\Component\Translation\t;

class AdminController extends \App\Http\Controllers\Controller
{
    public function index(){
        $start_time = Carbon::parse(Company::first()->start_time);
        $a = Auth::user()->attendence()->whereDate('created_at' , now())->first();
        $check_in = Carbon::parse($a->check_in);
        $check_out = Carbon::parse($a->check_out);
        $max_leave_days = 0;
        $total_leave_days = 0;

        foreach (Leave::all() as $leave){
            $max_leave_days = $max_leave_days + $leave->max_per_month;
        }

        foreach (Auth::user()->leaves()->get() as $leave){
            $total_leave_days = $total_leave_days + $leave->pivot->days;
        }

        return view('admin.dashbord' , [
            'departments' => Department::all(),
            'jobs' => Job::all(),
            'employees' => User::all(),
            'holidays' => Holiday::all(),
            'my_attendance' => $a,
            'current_hours' =>  $a->check_out == null ? (now()->diff($check_in))->h : ($check_out->diff($check_in))->h,
            'overtime_hours' => Auth::user()->overtime_hours,
            'max_leave_days' => $max_leave_days,
            'total_leave_days' => $total_leave_days,
            'vacation_leavers' => DB::table('leave_user')->where('status' , 'approved')->whereDate('from' , '<=' , now())->whereDate('to' , '>=' , now())->get(),
            'present_employees' => Attendence::whereDate('created_at' , now())->where('status' , 'present')->get(),
            'absent_employees' => Attendence::whereDate('created_at' , now())->where('status' , 'absent')->get(),
        ]);
    }

    public function check_in(){
        $user=Auth::user();
        $a = $user->attendence()->whereDate('created_at' , now())->first();

        if($a->check_in == null){
            $a->check_in = now();
            $a->status = 'present';
            $a->save();

            return redirect(route('admin.dashboard'));
        }

        if($a->check_out == null && $a->check_in != null){
            $a->check_out = now();
            $check_in = Carbon::parse($a->check_in);
            $check_out = Carbon::parse($a->check_out);
            $finsh_time= Carbon::parse(Company::first()->finish_time);

            if($check_out->lte($finsh_time) ){
                $user->hours_per_month = $user->hours_per_month + $check_in->diff($check_out)->h + $check_in->diff($check_out)->i/60;
                $user->save();
            }
            else{
                $user->hours_per_month =$user->hours_per_month + $check_in->diff($finsh_time)->h + $check_in->diff($finsh_time)->i/60;
                $user->save();

                if($overtime = Overtime::where('user_id' , $user->id)->whereDate('created_at' , now())->first()){

                    if($check_out->diff($finsh_time)->h + $check_out->diff($finsh_time)->i/60 <= ($overtime->hours)){
                        $user->overtime_hours = $user->overtime_hours + $check_out->diff($finsh_time)->h +  $check_out->diff($finsh_time)->i/60;
                        $user->save();
                        $a->overtime = $check_out->diff($finsh_time)->h +  $check_out->diff($finsh_time)->i/60;
                        $a->save();
                    }
                    else{
                        $user->overtime_hours = $user->overtime_hours + $overtime->hours;
                        $user->save();
                        $a->overtime = $overtime->hours;
                        $a->save();

                    }

                }
            }

        }
        $a->save();
        return redirect(route('admin.dashboard'));
    }


    public function profile($id){
        return view('admin.profile.index' , [
            'employee' => User::find($id),
            ]);
    }

//-----------Edit-Profile-----------------------------
    public function edit_profile($id){
        return view('admin.profile.edit-profile_info' , [
            'employee' => User::find($id),
            'jobs' => Job::all(),
            ]);
    }


    public function update_profile($id){
        $employee = User::find($id);
        $validated = $this->ValidateProfile();
        $employee->update($validated);
        if ($validated['image']) {
            $image_path = $employee->first_name . '.' . $validated['image']->extension();
            $validated['image']->move(public_path('images'), $image_path);
            $employee->update(['image_path' => $image_path]);
        }

        return redirect(route('admin.profile.index' , $employee->id));
    }


    public function ValidateProfile(){
        return request()->validate([
            'first_name' => ['required' , 'max:20'],
            'last_name' => ['required' , 'max:20'],
            'job_id' => ['required' , 'exists:jobs,id'],
            'mobile_number' => ['required' , 'numeric'],
            'email' => ['required' , 'email' ],
            'birth_date' => ['required' , 'date' ],
            'gender' => ['required' , 'string' , 'in:male,female'],
            'address' => ['required' , 'string'],
            'image' => ['mimes:png,jpeg,jpg'],
        ]);
    }



//-----------Edit-Info-----------------------------
    public function edit_info($id){
        return view('admin.profile.edit-personal_info' , [
            'employee' => User::find($id),
            ]);
    }


    public function update_info($id){
        $employee = User::find($id);
        $employee->update($this->ValidateInfo());

       return redirect(route('admin.profile.index' , $employee->id));
    }


    public function ValidateInfo(){
        return request()->validate([
            'nationality' => ['required' , 'string' , 'max:20'],
            'hometown' => ['required' , 'string' , 'max:20'],
            'marital_status' => ['required' , 'string' , 'in:single,married'],
            'number_of_children' => ['required' , 'numeric'],
        ]);
    }


//-----------Edit-Emergency-----------------------------
    public function edit_emergency($id){
        return view('admin.profile.edit-Emergency-Contact' , [
            'employee' => User::find($id),
            ]);
    }


    public function update_emergency($id){
        $employee = User::find($id);
        $employee->update($this->ValidateEmergency());

       return redirect(route('admin.profile.index' , $employee->id));
    }


    public function ValidateEmergency(){
        return request()->validate([
            'emergency_name' => ['required' , 'string' , 'max:30'],
            'emergency_relation' => ['required' , 'string' , 'max:10'],
            'emergency_number' => ['required' , 'string' , 'max:10'],
        ]);
    }


//-----------Edit-&-Create-Experience-----------------------------
    public function edit_experience($id){
        return view('admin.profile.edit-Experience' , [
            'employee' => User::find($id),
            ]);
    }


    public function create_experience($id){
        return redirect(route('admin.profile.edit_experience' , $id))->with([
            'employee' => User::find($id),
            'new' => 'new',
        ]);
    }


    public function store_experience($id){
        $validated = $this->ValidateExperience();
        $from = Carbon::parse($validated['from']);
        $to = Carbon::parse($validated['to']);

        $employee = User::find($id);
        $experience = new Experience($validated);
        $experience->user_id = $id;
        $experience->from = $from;
        $experience->to = $to;
        $experience->save();

       return redirect(route('admin.profile.index' , $employee->id));
    }


    public function update_experience($id){
        $validated = $this->ValidateExperience();
        $from = Carbon::parse($validated['from']);
        $to = Carbon::parse($validated['to']);
        $experience = Experience::find($id);

        $experience->update($this->ValidateExperience());
        $experience->from = $from;
        $experience->to = $to;
        $experience->save();

       return redirect(route('admin.profile.index' , User::find($experience->user_id)));
    }


    public function delete_experience($id){
        $experience = Experience::find($id);
        $experience->delete();

       return redirect(route('admin.profile.edit_experience' , User::find($experience->user_id)));
    }


    public function ValidateExperience(){
        return request()->validate([
            'company' => ['required' , 'string' ],
            'location' => ['required' , 'string' ],
            'position' => ['required' , 'string'],
            'from' => ['required' , 'date' ],
            'to' => ['required' , 'date' , 'after:from'],
        ]);
    }


//-----------Edit-&-Create-Education-----------------------------
    public function edit_education($id){
        return view('admin.profile.edit-Education-Informations' , [
            'employee' => User::find($id),
            ]);
    }


    public function create_education($id){
        return redirect(route('admin.profile.edit_education' , $id))->with([
            'employee' => User::find($id),
            'new' => 'new',
        ]);
    }


    public function store_education($id){
        $validated = $this->ValidateEducation();
        $from = Carbon::parse($validated['from']);
        $to = Carbon::parse($validated['to']);

        $employee = User::find($id);
        $education = new Education($validated);
        $education->user_id = $id;
        $education->from = $from;
        $education->to = $to;
        $education->save();

       return redirect(route('admin.profile.index' , $employee->id));
    }


    public function update_education($id){
        $validated = $this->ValidateEducation();
        $from = Carbon::parse($validated['from']);
        $to = Carbon::parse($validated['to']);
        $education = Education::find($id);

        $education->update($this->ValidateEducation());
        $education->from = $from;
        $education->to = $to;
        $education->save();

       return redirect(route('admin.profile.index' , User::find($education->user_id)));
    }


    public function delete_education($id){
        $education = Education::find($id);
        $education->delete();

       return redirect(route('admin.profile.edit_education' , User::find($education->user_id)));
    }


    public function ValidateEducation(){
        return request()->validate([
            'university' => ['required' , 'string' ],
            'speciality' => ['required' , 'string' ],
            'from' => ['required' , 'date' ],
            'to' => ['required' , 'date' , 'after:from'],
            'grade' => ['required' , 'string'],
            'degree' => ['required' , 'string'],

        ]);
    }

}
