<?php

namespace App\Http\Controllers\Frontend\Parent;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class BookingsController extends Controller
{
    public function index()
    {
        return view('frontend.parent.parent_booking');
    }
}
