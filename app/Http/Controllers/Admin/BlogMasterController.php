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
        $data['query'] = BlogMasterHelper::getList();
        return view('admin.blog.add_blog', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            // 'blog_image' => 'required',
            'description' => 'required'
        ]); 
        if ($validator->fails()) {
          return response(['error_msg' => $validator->errors()->all(), 'status' => 'inactive', 'data' => array()], 400);
      }          
          $simagesEnglish = '';
          if ($request->file('blog_image') != '') {
              $simagesEnglish = $this->uploadImageWithCompress($request->file('blog_image'), 'uploads/blog');
          }
        
        $data_array = array(
          'title' => $request->title,
          'description' => $request->description,
       );
       if ($simagesEnglish != '') {
        $data_array['blog_image'] = $simagesEnglish;
    }
        $update = BlogMasterHelper::save($data_array);
        if ($update) {
            Session::flash('success', trans('messages.addedSuccessfully'));
            return redirect()->route('blog-master.index');
        }
        else {
            Session::flash('error', trans('messages.notAdded'));
            return redirect()->back();
        }
            
    }

    public function edit($id)
    {
 
        $data['blog']=BlogMasterHelper::getDetailsById($id);
        return view('admin.blog.edit_blog', $data);
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
               'title' => 'required',
               'image' => 'required',
               'description' => 'required'
               
            ]);
            if ($validator->fails()) {
                return response()->json(['error_msg' => $validator->errors()->all(), 'status' => 'inactive', 'data' => array()], 400);
            }
            $udpadedata_array = array(
               'title' => $request->title,
               'description' => $request->description,
            );
            $update = BlogMasterHelper::update($udpadedata_array,array('id'=>$request->input('id')));
            $query=BlogMasterHelper::getDetailsById($request->input('id'));
            if ($update) {
              Session::flash('success', trans('messages.addedSuccessfully'));
              return redirect()->route('blog-master.index');
          }
          else {
              Session::flash('error', trans('messages.notAdded'));
              return redirect()->back();
          }
       }
       public function show($id)
       {
           $data['blog']=BlogMasterHelper::getDetailsById($id);
           if(isset($data['blog']->id)){
               return view('admin.blog.view_blog',$data);
           }else{
               abort(404);
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
               'message' =>  trans('messages.notDeleted')
           ]);
       }
     }

       public function changeStatus(Request $request){
        $query = UserHelper::updateStatus($request->id,$request->status);
        if($query){
         return response()->json(['error_msg' =>trans('messages.updatedSuccessfully'), 'data' => array('status'=>$request->status)], 200);
        }else{
         return response()->json(['error_msg' =>trans('messages.error'), 'data' => array()], 500);
        }
    }



}
