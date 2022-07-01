<?php

namespace App\Http\Controllers\Frontend\Parent;

use App\Helpers\ParentDetailHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ParentLessonPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = "Lesson Payment";
        return view('frontend.parent.parent-lesson-payment', $data);
    }

    public function lessonAjaxList(Request $request)
    {
        $auth = Auth::user();
        $id = $auth['id'];
        $data['page'] = $request->page;
        $data['query'] = ParentDetailHelper::getPaidParentListWithPaginate($id);
        return view('frontend.parent.parent-support-ajax', $data);
    }
}
