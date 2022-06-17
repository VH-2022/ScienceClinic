<?php

namespace App\Http\Controllers\Frontend\Parent;

use App\Helpers\ParentDetailHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
   public function index()
   {
    $parentId = Auth::user()->id;
     $parentDetails['data'] = ParentDetailHelper::getParentsByBookings($parentId);
    //  dd($parentDetails['data']);
    return view('frontend.parent.parent_feedback',$parentDetails);
   }
}
