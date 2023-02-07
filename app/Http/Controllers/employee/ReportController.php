<?php

namespace App\Http\Controllers\employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;
class ReportController extends Controller
{
    //
    public function index(){
        return view('employee.report.index',[
            'reports' => Auth::user()->reports->all()
        ]);
    }
    public function addreport(){
        return view('employee.report.add-my-report');
    }

    public function edit($id){
        return view('employee.report.edit-my-report',['id'=>$id]);
    }
    public function store(){
        $report = new Report($this->ValidateReport());
        $report->user_id= Auth::user()->id;
        $report->save();
        return redirect(route('employee.report.index'));
    }

    public function update($id){
        $report = Report::find($id);
        $report->update($this->ValidateEditedReport());
        return redirect(route('employee.report.index'));

    }

    public function ValidateReport(){
        return request()->validate([
            'title' => ['required','string'],
            'body' => ['required','string' ]
        ]);
    }
    public function ValidateEditedReport(){
        return request()->validate([
            'title' => ['required','string'],
            'body' => ['required','string' ]
        ]);
    }
    public function delete(){
        $d = Report::find(request('report_id'));
        $d->delete();
        return redirect(route('employee.report.index'));

    }

}
