<?php

namespace App\Http\Controllers\employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Salary;
use App\Models\Company;
use Carbon\Carbon;
class SalaryController extends Controller
{
    //
    public function index(){
        $overtime=0;
        $Movertime=0;
        $company=Company::first();

        $start= Carbon::parse($company->start_time);
        $end= Carbon::parse($company->finish_time);
        $minutes=$start->diffInMinutes($end);
        $n=$minutes/60;
        if (Auth::user()->salary != null) {
            $salary = Auth::user()->salary->net;
            $all = $n * $salary;
        }
        else{
            $all=0;
        }

       foreach(Auth::user()->attendence()->get() as $attendance){
           $overtime=$overtime + ($attendance->overtime);
       }
       foreach(Auth::user()->leaves()->where('is_paid','1')->get() as $leave){
        $Movertime = $all*$leave->pivot->days + $Movertime;
       }
        return view('employee.salary.index' , [
            'employee' => Auth::user(),
            'leaves'   => Auth::user()->leaves(),
            'money'    => $all ,
            'date'     =>Carbon::now() ,
            'overtime' => $overtime ,
            'Movertime'=>$Movertime ]);
    }

}
