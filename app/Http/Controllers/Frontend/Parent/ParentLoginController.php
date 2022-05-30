<?php

namespace App\Http\Controllers\Frontend\Parent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class ParentLoginController extends Controller
{
    public function index()
    {
        return view('Frontend.parent.parent_login');
    }
    public function verifyLogin(Request $request)

    {

        $input = $request->all();
        $this->validate($request, [

            'email' => 'required|email',

            'password' => 'required',

        ]);

        $remember_me = $request->has('remember') ? 1 : 0;
        if (auth()->guard('parent')->attempt([

            'email' => $request->email,

            'password' => $request->password,

            'type' => 3

        ])) {

            Session::flash('success', trans('messages.successLogin'));
            return redirect('parent-dashboard');
        } else {
            return redirect()->route('parent-login')->with('error', trans('messages.errorLogin'));
        }
    }
}
