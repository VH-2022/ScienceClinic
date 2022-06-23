<?php

namespace App\Http\Controllers\Frontend\Tutor;

use App\Helpers\FeedbackHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TutorFeedBackController extends Controller
{
    public function index()
    {
        return view('frontend.tutor.tutor-feedback');
    }
    public function ajaxList(Request $request)
    {
        $auth = Auth::guard('web')->user();
        $id = $auth['id'];
        $data['page'] = $request->page;
        $data['query'] = FeedbackHelper::getListFeedbackWithPaginate($id);
        return view('frontend.tutor.tutor-feedback-ajax', $data);
    }
}
