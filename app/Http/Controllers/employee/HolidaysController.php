<?php

namespace App\Http\Controllers\employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Holiday;
class HolidaysController extends Controller
{
    //
    public function index(){
        return view('employee.holiday.index',[

            'holidays'=>Holiday::all()
        ] );
      
    }
}
