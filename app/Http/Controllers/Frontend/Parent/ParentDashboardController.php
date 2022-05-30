<?php

namespace App\Http\Controllers\Frontend\Parent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ParentDashboardController extends Controller
{
    public function index()
    {
        return view('frontend.parent.parent_dashboard');
    }
}
