<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TutorLevel;
use App\Helpers\TutorLevelHelper;
use Validator;
use Session;

class TutorLevelController extends Controller
{
    public $successStatus =200;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $level=TutorLevel::All();
       return view('admin.tutorlevel.tutorlevel');
    }
    public function ajaxList(Request $request){
        $data['page'] = $request->input('page');
        $data['query'] = TutorLevelHelper::getListwithPaginate();
        return view('admin.tutorlevel.tutor_level_ajax',$data);
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
         ]);
         if ($validator->fails()) {
             return response()->json(['error_msg' => $validator->errors()->all(), 'status' => 'inactive', 'data' => array()], 400);
         }
         $data_array = array(
            'title' => $request->input('title')
         );
         $update = TutorLevelHelper::save($data_array);
            if($update){        
         
         return response()->json(['error_msg' =>trans('messages.addedSuccessfully'), 'data' => array()], 200);
         }else{
            return response()->json(['error_msg' =>trans('messages.error'), 'data' => array()], 200);
      }
   }

   public function edit($id)
   {
       $auth = auth()->user();
       if(empty($auth)){
           return redirect('/login');
       }

       return view('admin.tutorlevel.tutorlevel',$data);
   }
   public function update(Request $request, $id)
   {
          $validator = Validator::make($request->all(), [
              'title' => 'required',
           ]);
           if ($validator->fails()) {
               return response()->json(['error_msg' => $validator->errors()->all(), 'status' => 'inactive', 'data' => array()], 400);
           }
           $data_array = array(
              'title' => $request->input('title')
           );
           $update = TutorLevelHelper::update($data_array,array('id'=>$request->input('id')));
              if($update){        
           
           return response()->json(['error_msg' =>trans('messages.addedSuccessfully'), 'data' => array()], 200);
           }else{
              return response()->json(['error_msg' =>trans('messages.error'), 'data' => array()], 200);
        }
      }













   public function updateStatus(Request $request)
    {
        $level = TutorLevel::find($request->id);
        $level->status = $request->status;
        $level->save();
        if ($level) {
            return response()->json([
                'message' => trans('messages.statusSuccessfully')
            ]);
            }
            else {
            return response()->json([
                'message' =>  trans('messages.notStatused')
            ]);
        }
    }
}