<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends \App\Http\Controllers\Controller
{
    public function index(){
        return view('admin.activities.index' , ['employee' => Auth::user()]);
    }
}
