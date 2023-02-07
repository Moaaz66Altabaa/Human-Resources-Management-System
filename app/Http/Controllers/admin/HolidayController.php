<?php

namespace App\Http\Controllers\admin;

use App\Models\Holiday;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HolidayController extends \App\Http\Controllers\Controller
{
    public function index(){
        return view('admin.holiday.index' , ['holidays' => Holiday::all()]);
    }


//    public function show($id){
//        return view('admin.holiday.show' , ['holiday' => Holiday::find($id)]);
//    }


    public function create(){
        return view('admin.holiday.create' );
    }


    public function store(){
        $validated = $this->validateHoliday();
        $holiday = new Holiday($validated);
        $from = Carbon::parse($validated['from']);
        $to = Carbon::parse($validated['to']);

        if ($from->day == now()->day){
            return redirect(route('admin.holiday.create'))->with(['invalid_date_error' => 'you cannot add holiday that starts today']);
        }

        if ($from->isPast() || $to->isPast()){
            return redirect(route('admin.holiday.create'))->with(['invalid_date_error' => 'the date you entered has passed']);
        }

        $holiday->from = $from;
        $holiday->to = $to;
        $holiday->days = $from->diff($to)->days + 1;
        $holiday->save();

        return redirect(route('admin.holiday.index'));
    }


    public function edit($id){
        return view('admin.holiday.edit' , ['holiday' => Holiday::find($id)]);
    }


    public function update($id){
        $validated = $this->validateHoliday();
        $holiday = Holiday::find($id);
        $from = Carbon::parse($validated['from']);
        $to = Carbon::parse($validated['to']);

        if ($from->day == now()->day){
            return redirect(route('admin.holiday.create'))->with(['invalid_date_error' => 'you cannot add holiday that starts today']);
        }

        if ($from->isPast() || $to->isPast()){
            return redirect(route('admin.holiday.create'))->with(['invalid_date_error' => 'the date you entered has passed']);
        }

        $holiday->name = $validated['name'];
        $holiday->from = $from;
        $holiday->to = $to;
        $holiday->days = $from->diff($to)->days + 1;
        $holiday->save();

        return redirect(route('admin.holiday.index'));
    }


    public function delete(){
        $holiday = Holiday::find(request('holiday_id'));
        $holiday->delete();

        return redirect(route('admin.holiday.index'));
    }


    public function validateHoliday(){
        return request()->validate([
            'name' => ['required' , 'string'],
            'from' => ['required' , 'date'],
            'to' => ['required' , 'date' , 'after:from'],
        ]);
    }


}
