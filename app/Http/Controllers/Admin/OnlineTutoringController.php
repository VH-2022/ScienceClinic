<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\OnlineTutoringHelper;
use App\Helpers\SubjectHelper;
use App\Helpers\SubjectOtherSectionMasterHelper;
use App\Helpers\SubjectBannerHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Traits\ImageUploadTrait;
use Validator;
use Session;
class OnlineTutoringController extends Controller
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
        return view('admin.online_tutoring.online_tutoring');
    }
    public function ajaxList(Request $request){
        $data['page'] = $request->input('page');
        $created_date = $request->input('created_date');
        $title = $request->input('title');
        $data['query'] = OnlineTutoringHelper::getListwithPaginate($title,$created_date);
        return view('admin.online_tutoring.online_tutoring_ajax_list',$data);
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
        return view('admin.online_tutoring.addonline_tutoring');
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
            'online_tutoring_name' => 'required|max:255|unique:sc_online_tutoring,online_tutoring_name,null,id,deleted_at,NULL',
            'online_tutoring_link' => 'required|url|unique:sc_online_tutoring,online_tutoring_link,null,id,deleted_at,NULL',
        ]);
        if ($validator->fails()) {
            return redirect("/online-tutoring/create")
            ->withErrors($validator, 'useredit')
            ->withInput();
        } else {
            $userId = Auth()->user()->id;
            $data_array = array(
                'user_id' => $userId,
                'online_tutoring_name' => $request->input('online_tutoring_name'),
                'online_tutoring_link' => $request->input('online_tutoring_link'),
            );
            
            $insert = OnlineTutoringHelper::save($data_array);
            if($insert){
                
                Session::flash('success',trans('messages.addedSuccessfully'));
                return redirect('/online-tutoring');
            }else{
                Session::flash('error',trans('messages.error'));
                return redirect('/online-tutoring/create');
                
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
        $data['basic_details'] = OnlineTutoringHelper::getDetailsByid($id);
        return view('admin.online_tutoring.edit_online_tutoring',$data);
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
            'online_tutoring_name' => 'required|max:255|unique:sc_online_tutoring,online_tutoring_name,' . $id . ',id,deleted_at,NULL',
            'online_tutoring_link' => 'required|url|unique:sc_online_tutoring,online_tutoring_link,' . $id . ',id,deleted_at,NULL',
        ]);
        if ($validator->fails()) {
            return redirect("/subject-master/".$request->input('id').'/edit')
            ->withErrors($validator, 'useredit')
            ->withInput();
        } else {
            $data_array = array(
                'online_tutoring_name' => $request->input('online_tutoring_name'),
                'online_tutoring_link' => $request->input('online_tutoring_link'),
            );
            
            $update = OnlineTutoringHelper::update($data_array,array('id' => $id));
            if($update){
                Session::flash('success',trans('messages.updatedSuccessfully'));
                return redirect('/online-tutoring');
            }else{
                Session::flash('error',trans('messages.error'));
                return redirect('/online-tutoring/'.$id.'/edit');
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
      

        $update = OnlineTutoringHelper::SoftDelete(array(), array('id' => $id));

        if ($update) {
            return response()->json(['error_msg' => trans('messages.deletedSuccessfully'), 'data' => array()], 200);
        } else {
            return response()->json(['error_msg' => trans('messages.error_msg'),'data' => array()], 500);
        }
    }

    
}
