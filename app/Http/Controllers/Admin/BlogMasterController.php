<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\BlogMasterHelper;
use App\Http\Traits\ImageUploadTrait;
use Validator;
use Session; 

class BlogMasterController extends Controller
{
    use ImageUploadTrait;
    public $successStatus =200;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         
      return view('admin.blog.blog');
    }
    public function ajaxList(Request $request){
        $data['page'] = $request->page; 
        $title = $request->title;
        $created_date = $request->created_date;
        $data['query'] = BlogMasterHelper::getListwithPaginate($title,$created_date);
        return view('admin.blog.blog_ajax',$data);
     }
    
       /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $auth = auth()->user();
        if(empty($auth)){
            return redirect('/login');
        }
        return view('admin.blog.add_blog');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'image' => 'required|mimes:jpg,jpeg,png,bmp,tiff',
            'description' => 'required'
         ]);
                 
         $image = '';
            if ($request->file('image') != '') {
                $image = $this->uploadImageWithCompress($request->file('image'), 'uploads/blog');
            }
        
        $data_array = array(
          'title' => $request->title,
          'description' => $request->description,
          'image'=>$image

       );
        $update = BlogMasterHelper::save($data_array);
        if ($update) {
            Session::flash('success', trans('messages.addedSuccessfully'));
            return redirect()->route('blog-master.index');
        }
        else {
            Session::flash('error', trans('messages.error'));
            return redirect()->back();
        }
            
    }
    public function show($id)
    {
        $data['blog']=BlogMasterHelper::getDetailsById ($id);
        if(isset($data['blog']->id)){
            return view('admin.blog.view_blog',$data);
        }else{
            abort(404);
           }
    }

    public function edit($id)
    {
        $auth = auth()->user();
        if(empty($auth)){
            return redirect('/login');
        }
        $data['blog']=BlogMasterHelper::getDetailsById($id);
        return view('admin.blog.edit_blog', $data);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);
        
        $image = '';
        if ($request->file('image') != '') {
            $image = $this->uploadImageWithCompress($request->file('image'), 'uploads/blog');
        }
        
        $data_array = array(
        'title' => $request->title,
        'description' => $request->description
        );
        if ($image != '') {
            $data_array['image'] = $image;
        }

        $update = BlogMasterHelper::update($data_array,array('id'=>$request->id));
        if ($update) {
            Session::flash('success',trans('messages.updatedSuccessfully'));
            return redirect()->route('blog-master.index');
        }
        else {
            Session::flash('error', trans('messages.error'));
            return redirect()->back();
        }
    }
    public function destroy($id)
    {
        $update = BlogMasterHelper::SoftDelete(array(),array('id'=>$id));
        if ($update) {
            return response()->json([
                'message' => trans('messages.deletedSuccessfully')
            ]);
            }
            else {
            return response()->json([
                'message' =>  trans('messages.error')
            ]);
        }
    }

}
