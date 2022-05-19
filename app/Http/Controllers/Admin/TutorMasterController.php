<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Helpers\TutorMasterHelper;
use Validator;
use Session;

class TutorMasterController extends Controller
{
    public $successStatus =200;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $totur=User::get();
       return view('admin.tutor.tutor');
    }
    public function ajaxList(Request $request){
        $data['page'] = $request->input('page');
        $first_name = $request->input('first_name');
        $email = $request->input('email');
        $mobile = $request->input('mobile_id');
        $created_date = $request->input('created_date');
        $data['query'] = TutorMasterHelper::getListwithPaginate($first_name,$email,$mobile,$created_date);
        return view('admin.tutor.tutor_ajax',$data);
    }
    public function destroy($id)
    {
    $update = TutorMasterHelper::SoftDelete(array(),array('id'=>$id));
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
    public function show($id)
    {
            $data['totuer']=TutorMasterHelper::getDetailsById($id);
            return view('admin.tutor.tutor_view',$data);
    }
}
