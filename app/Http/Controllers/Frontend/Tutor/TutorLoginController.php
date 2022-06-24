<?php

namespace App\Http\Controllers\Frontend\Tutor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class TutorLoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend.tutor.tutor-login');
    }

    public function verifyLogin(Request $request)

    {

        $input = $request->all();
        $this->validate($request, [

            'email' => 'required|email',

            'password' => 'required',

        ]);

        $remember_me = $request->has('remember') ? 1 : 0;
        if (auth()->guard('web')->attempt([
            
            'email' => $request->email,

            'password' => $request->password,

            'type' => 2

        ])) {
           
            Session::flash('success', trans('messages.successLogin'));
            return redirect('tutor-account');
        } else {
            return redirect()->route('tutor-login')->with('error', trans('messages.errorLogin'));
        }
    }
    public function logout(Request $request)

    {
        Auth::guard('web')->logout();
        Session::flash('success', trans('messages.successLogout'));
        return redirect('tutor-login');

    }
}
