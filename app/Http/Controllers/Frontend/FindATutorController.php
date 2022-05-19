<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class FindATutorController extends Controller
{
   public function index()
   {
       return view('frontend.find_a_tutor.index');
   }
}
