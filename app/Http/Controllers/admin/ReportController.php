<?php

namespace App\Http\Controllers\admin;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends \App\Http\Controllers\Controller
{
    public function index(){
        return view('admin.reports.index' , ['reports' => Report::all()]);
    }


    public function my_reports(){
        return view('admin.reports.my_reports' , ['reports' => Auth::user()->reports()->get()]);
    }


    public function search(){
        $reports = Report::where('title' , request('title'))->get();

        return redirect(route('admin.reports.index'))->with([
            'search' => $reports,
        ]);
    }


    public function create(){
        return view('admin.reports.create');
    }


    public function store(){
        $report = new Report($this->validateReport());
        $report->user_id = Auth::user()->id;
        $report->save();

        return redirect(route('admin.reports.my_reports'));
    }


    public function edit($id){
        return view('admin.reports.edit' , ['report' => Report::find($id)]);
    }


    public function update($id){
        $report = Report::find($id);
        $report->update($this->validateReport());
        return redirect(route('admin.reports.my_reports'));
    }


    public function delete(){
        $reprot = Report::find(request('report_id'));
        $reprot->delete();

        return redirect(route('admin.reports.my_reports'));
    }

    public function validateReport(){
        return request()->validate([
            'title' => ['string' , 'required' , 'in:Salary Report,Leave Report,Overtime Report,System Report,Employees Report,Department Report,Others'],
            'body' => ['string' , 'required' ]
        ]);
    }
}
