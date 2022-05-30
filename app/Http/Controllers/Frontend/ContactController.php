<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ContactHelper;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function index(){
        return view('frontend.contact.contact');
    }
    
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
              'name' => 'required|min:4|max:255',
              'phone_no' => 'required',
              'tutor_type' => 'required',
              'email' => 'required|email|regex:/^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i',
              'address' => 'required',
              'message' => 'required'
           ]);
           
                   
            if ($validator->fails()) {
                response()->json(['error_msg' => $validator->errors()->all(),  'data' => array()], 400);
        }
        $data_array = array(
                    'name' => $request->name,
                    'phone_no' => $request->phone_no,
                    'tutor_type' => $request->tutor_type,
                    'email' => $request->email,
                    'address' =>$request->address,
                    'message' => $request->message
          
                 );
        $update = ContactHelper::save($data_array);
        if($update){        

        return response()->json(['error_msg' =>trans('messages.addedSuccessfully'), 'data' => array()], 200);
        }else{
            return response()->json(['error_msg' =>trans('messages.error'), 'data' => array()], 500);
        }
    }
}
