<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\LoginRequest;

class LoginController extends Controller
{

    public function showLoginForm()
    {
    	return view('auth.Dashboard.login');
    }

    public function login(LoginRequest $request)
    {
    	$remember_me = $request->has('remember_me') ? true : false;

    	if(auth()->guard('dashboard')->attempt(['email' => $request->input("email"), 'password' => $request->input("password")]))
    	{
    		return redirect()->route('admin.index');
    	}

    	return redirect()->back()->with(['error' => 'هناك خطأ فى بيانات الدخول']);

    }
}
