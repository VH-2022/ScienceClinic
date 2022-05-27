<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\AboutHelper;
use App\Http\Traits\ImageUploadTrait;
use Validator;
use Session;

class AboutController extends Controller
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
    public function edit($id)
    {
        $auth = auth()->user();
        if(empty($auth)){
            return redirect('/login');
        }
        $data['about']=AboutHelper::getDetailsById($id);
        return view('admin.about.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            
            'content1' => 'required',
            'content2' => 'required'
        ]);

        $image = '';
        if ($request->file('image') != '') {
            $image = $this->uploadImageWithCompress($request->file('image'), 'uploads/about');
        }
        $data_array = array(
        'content1' => $request->content1,
        'content2' => $request->content2
        );
        if ($image != '') {
            $data_array['image'] = $image;
        }

        $update = AboutHelper::update($data_array,array('id'=>$request->id));
        if ($update) {
            Session::flash('success',trans('messages.updatedSuccessfully'));
            return redirect()->route('about.index');
        }
        else {
            Session::flash('error', trans('messages.error'));
            return redirect()->back();
        }
    }
}
