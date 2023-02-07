<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SignInController extends Controller
{
    public function index(){
        if(!Auth::user()) {
            return view('auth.login');
        }
        return redirect()->back();
    }

    public function login(){
        $validated = request()->validate(['email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt([ 'email' => request('email') , 'password' => request('password')])){
            if (Auth::user()->is_admin){ return redirect()->route('admin.dashboard'); }
            else{return redirect()->route('employee.dashboard');}
        }
        else{
            return redirect(route('login'))->with(['signInError' => 'you entered an invalid credentials']);
        }
    }
}
