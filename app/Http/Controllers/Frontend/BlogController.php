<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\BlogMasterHelper;
use App\Http\Traits\ImageUploadTrait;
use Validator;
use Session; 

class BlogController extends Controller
{
  use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data['blog'] = BlogMasterHelper::getBlogList();
        return view('frontend.Blog.blog',$data);
    }
    public function blogDetails($id){
      $data['blog'] = BlogMasterHelper::getDetailsById($id);
      return view('frontend.Blog.blog-deatils',$data);
  }
}
