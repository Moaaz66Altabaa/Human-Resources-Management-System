<?php

namespace App\Http\Controllers\employee;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Department;
use App\Models\Leave;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Company;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends \App\Http\Controllers\Controller
{
    public function index(){
        $a = Auth::user()->attendence()->whereDate('created_at' , now())->first();
        $check_in = Carbon::parse($a->check_in);
        $check_out = Carbon::parse($a->check_out);
        $count_leave=0;
        foreach(Auth::user()->leaves as $leave){
        $count_leave=$count_leave + $leave->pivot->days;
        }
        $count_leave_day=0;
        foreach(Leave::all() as $leave){
        $count_leave_day=$count_leave_day + $leave->max_per_month;
        }

        return view('employee.dashboard',[
        'current_hours' =>  $a->check_out == null ? (now()->diff($check_in))->h : ($check_out->diff($check_in))->h,
        'employee' => Auth::user(),
        'leave'=>$count_leave,
        'leave_day'=>$count_leave_day,
        'my_attendance' => $a,
    ]);
    }

    public function profile(){
        $department=Department::find(Auth::user()->job->department_id);

        return view('employee.employee.profile',[
            'department' =>$department,
            'employee'   => Auth::user(),

        ]);

    }

    public function edit_profile(){
        return view('employee.employee.edit-profile_info',['employee'=>Auth::user()]


        );
    }
    public function update_profile(){
        $employee = Auth::user();
        $validated = $this->ValidateEditedEmployee_profile();
        $employee->update($this->CreateEditedEmployee_profile());
        $image_path = $employee->first_name . '.' . $validated['image']->extension();
        $validated['image']->move(public_path('images') ,  $image_path );
        $employee->update(['image_path' => $image_path]);
        return redirect(route('employee.employee.profile'));
    }

    public function ValidateEditedEmployee_profile(){
        return request()->validate([
            'birth_date'=>['required','date'],
            'gender'=>['required','string','in:male,female'],
            'mobile_number'=>['required','string'],
            'address'=>['required','string'],
            'email' => ['required' , 'email' ],
            'password' => ['required' , 'string' , 'min:8' ],
            'image'=>['mimes:jpeg,jpg,png']
        ]);
    }
    public function CreateEditedEmployee_profile(){
        $validated = $this->ValidateEditedEmployee_profile();
        $data = [
            'birth_date'=>$validated['birth_date'],
            'gender'=>$validated['gender'],
            'mobile_number'=> $validated['mobile_number'],
            'address'=> $validated['address'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'image' =>$validated['image'],
        ];

        return $data;
    }

    public function edit_info(){
        return view('employee.employee.edit-personal_info',['employee'=>Auth::user()]


        );
    }
    public function update_info(){
        $employee = Auth::user();
        $employee->update($this->ValidateEditedEmployee_info());

        return redirect(route('employee.employee.profile'));
    }

    public function ValidateEditedEmployee_info(){
        return request()->validate([
            'nationality'=>['required','string'],
            'hometown'=>['required','string'],
            'marital_status'=>['required','in:single,married'],
            'number_of_children'=>['required' , 'numeric'],
        ]);
    }

    public function edit_emergency(){
        return view('employee.employee.edit-Emergency-Contact',['employee'=>Auth::user()]


        );

    }
    public function update_emergency(){
        $employee = Auth::user();
        $employee->update($this->ValidateEditedEmployee_emergency());

        return redirect(route('employee.employee.profile'));
    }

    public function ValidateEditedEmployee_emergency(){
        return request()->validate([
            'emergency_name'=>['required','string'],
            'emergency_relation'=>['required','string'],
            'emergency_number'=>['required','string'],


        ]);
    }public function edit_experience(){

        return view('employee.employee.edit-Experience' , [
            'employee' => User::find(Auth::user()->id),
            ]);
    }


    public function create_experience(){
        return redirect(route('employee.employee.edit_experience' ))->with([
            'employee' => Auth::user()->id,
            'new' => 'new',
        ]);
    }


    public function store_experience(){
        $validated = $this->ValidateExperience();
        $from = Carbon::parse($validated['from']);
        $to = Carbon::parse($validated['to']);

        $employee = Auth::user()->id;
        $experience = new Experience($validated);
        $experience->user_id = Auth::user()->id;
        $experience->from = $from;
        $experience->to = $to;
        $experience->save();

       return redirect(route('employee.employee.profile'));
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

       return redirect(route('employee.employee.profile' , User::find($experience->user_id)));
    }


    public function delete_experience($id){
        $experience = Experience::find($id);
        $experience->delete();

       return redirect(route('employee.employee.edit-Experience' , User::find($experience->user_id)));
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


    public function edit_education(){
        return view('employee.employee.edit-Education-Informations' , [
            'employee' => Auth::user(),
            ]);
    }


    public function create_education(){
        return redirect(route('employee.employee.edit_education' ))->with([
            'employee' => Auth::user()->id,
            'new' => 'new',
        ]);
    }


    public function store_education(){
        $validated = $this->ValidateEducation();
        $from = Carbon::parse($validated['from']);
        $to = Carbon::parse($validated['to']);

        $employee = Auth::user()->id;
        $education = new Education($validated);
        $education->user_id = Auth::user()->id;
        $education->from = $from;
        $education->to = $to;
        $education->save();

       return redirect(route('employee.employee.profile' ));
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

       return redirect(route('employee.employee.profile') );
    }


    public function delete_education($id){
        $education = Education::find($id);
        $education->delete();

       return redirect(route('employee.employee.edit_education' ));
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





    public function check_in(){
        $user=Auth::user();
        $a = $user->attendence()->whereDate('created_at' , now())->first();

        if($a->check_in == null){
            $a->check_in = now();
            $a->status = 'present';
            $a->save();

            return redirect(route('employee.dashboard'));
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
        return redirect(route('employee.dashboard'));
    }


}
