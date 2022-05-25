<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\TutorLevelHelper;
use App\Helpers\TutorSearchInquiryHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchInquiryController extends Controller
{
    public static function index()
    {
        return view('admin.subjectinquiry.index');
    }

    public function ajaxList(Request $request)
    {

        $data['page'] = $request->page;

        $title = $request->title;

        $created_date = $request->created_date;

        $data['query'] = TutorSearchInquiryHelper::getListwithPaginate($title, $created_date);

        return view('admin.subjectinquiry.search_inquiry_ajax', $data);
    }
}
