<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function verifyLogin(Request $request)
    {
        $input = $request->all();
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $remember_me = $request->has('remember') ? 1 : 0;
        if (auth()->guard('super_admin')->attempt([
            'email'=>$request->email,
            'password'=>$request->password,
            'type'=>1
        ])){
            Session::flash('success', trans('messages.successLogin'));
            return redirect('admin');
        }else{
            return redirect()->route('login')->with('error', trans('messages.errorLogin'));
        }
    }
    public function logout(Request $request)
    {
        Auth::guard('super_admin')->logout();
        Session::flash('success', trans('messages.successLogout'));
        return redirect('login');
    }
}
