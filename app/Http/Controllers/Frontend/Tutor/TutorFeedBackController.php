<?php

namespace App\Http\Controllers\Frontend\Tutor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TutorFeedBackController extends Controller
{
    public function index()
    {
        return view('frontend.tutor.tutor-feedback');
    }
}
