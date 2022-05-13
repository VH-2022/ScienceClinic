<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        
        return view('frontend.home.home');
    }
}
