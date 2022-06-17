<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\OnlineTutoringHelper;
use App\Helpers\SubjectHelper;
use App\Helpers\SubjectOtherSectionMasterHelper;
use App\Helpers\SubjectBannerHelper;
use App\Helpers\TutorResourcesHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Traits\ImageUploadTrait;
use Validator;
use Session;
class ELearningController extends Controller
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
        return view('admin.e_learning.e_learning');
    }
    public function ajaxList(Request $request){
        $data['page'] = $request->input('page');
        $created_date = $request->input('created_date');
        $title = $request->input('title');
        $data['query'] = TutorResourcesHelper::getListwithPaginateAdmin($title,$created_date);
        return view('admin.e_learning.e_learning_ajax_list',$data);
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
        return view('admin.e_learning.adde_learning');
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
            'title' => 'required|max:255|unique:sc_tutor_resources,title,null,id,deleted_at,NULL',
            'description' => 'required',
            'upload_data' => 'required|mimes:jpeg,png,jpg,gif,pptx,pdf,doc,docx',
        ]);
        if ($validator->fails()) {
            return redirect("/e-learning-cms/create")
            ->withErrors($validator, 'useredit')
            ->withInput();
        } else {
            $userId = Auth()->user()->id;
            $upload_data = '';
            if ($request->file('upload_data') != '') {
                $upload_data = $this->uploadImageWithCompress($request->file('upload_data'), 'uploads/resource');
            }
            $data_array = array(
                'user_id' => $userId,
                'title' => $request->input('title'),
                'description' => $request->input('description'),
            );
            if ($upload_data != '') {
                $data_array['upload_data'] = $upload_data;
            }
            $insert = TutorResourcesHelper::save($data_array);
            if($insert){
                
                Session::flash('success',trans('messages.addedSuccessfully'));
                return redirect('/e-learning-cms');
            }else{
                Session::flash('error',trans('messages.error'));
                return redirect('/e-learning-cms/create');
                
            }
           
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $auth = auth()->user();
        if(empty($auth)){
            return redirect('/login');
        }
        $data['basic_details'] = TutorResourcesHelper::getDetailsByid($id);
        return view('admin.e_learning.edit_e_learning',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255|unique:sc_tutor_resources,title,' . $id . ',id,deleted_at,NULL',
            'description' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect("/e-learning-cms/".$request->input('id').'/edit')
            ->withErrors($validator, 'useredit')
            ->withInput();
        } else {
            $upload_data = '';
            if ($request->file('upload_data') != '') {
                $upload_data = $this->uploadImageWithCompress($request->file('upload_data'), 'uploads/resource');
            }
            $data_array = array(
                'title' => $request->input('title'),
                'description' => $request->input('description'),
            );
            if ($upload_data != '') {
                $data_array['upload_data'] = $upload_data;
            }
            $update = TutorResourcesHelper::update(array('id' => $id),$data_array);
            if($update){
                Session::flash('success',trans('messages.updatedSuccessfully'));
                return redirect('/e-learning-cms');
            }else{
                Session::flash('error',trans('messages.error'));
                return redirect('/e-learning-cms/'.$id.'/edit');
            }
            
            
           
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      

        $update = TutorResourcesHelper::SoftDelete(array(), array('id' => $id));

        if ($update) {
            return response()->json(['error_msg' => trans('messages.deletedSuccessfully'), 'data' => array()], 200);
        } else {
            return response()->json(['error_msg' => trans('messages.error_msg'),'data' => array()], 500);
        }
    }

    
}
