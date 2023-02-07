<?php

namespace App\Http\Controllers\employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ActiviteController extends Controller
{
    //
    public function index(){
        return view('employee.activite.index',['employee'=>Auth::user()]);
    }
}
