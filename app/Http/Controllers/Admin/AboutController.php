<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\AboutHelper;
use Validator;
use Session;

class AboutController extends Controller
{
    public $successStatus =200;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
       return view('admin.about.about');
    }
    public function ajaxList(Request $request){
       
        $data['page'] = $request->page;
        $type = $request->type;
        $content1 = $request->content1;
        $content2 = $request->content2;
        $created_date = $request->created_date;
        $data['query'] = AboutHelper::getListwithPaginate($type,$content1,$content2,$created_date);
        return view('admin.about.about-ajax',$data);
    }
}
