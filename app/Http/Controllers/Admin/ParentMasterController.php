<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ParentDetailHelper;
use App\Helpers\TutorUniversityDetailHelper;
use App\Helpers\UserHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ParentMasterController extends Controller
{
   public function index()
   {
        return view('admin.parent.parent_list');  
   }
    public function ajaxList(Request $request)
    {

        $data['page'] = $request->page;
        $name = $request->name;
        $email = $request->email;
        $phone = $request->phone;
        $address = $request->address;
        $status = $request->status;

        $created_date = $request->created_date;

        $data['query'] = UserHelper::getParentList($name,$email,$phone,$address,$status,$created_date);
   
        return view('admin.parent.parent_list_ajax', $data);
    }

    public static function parentDetails($id)
    {
        
        $data['parents'] = UserHelper::getDetailsById($id);

        if (isset($data['parents']->id)) {

            return view('admin.parent.parent_details', $data);
        } else {

            abort(404);
        }
    }

    public function getInquiryDetails(Request $request)
    {

        $data['page'] = $request->page;
        $tutor_id = $request->tutor_id;
        $data['query'] = ParentDetailHelper::getListwithPaginate($tutor_id);
      

        return view('admin.parent.tutor_inquiry_list', $data);
    }

    public function destroy($id)

    {
  

        $update = UserHelper::SoftDelete(array(), array('id' => $id));

        if ($update) {

            return response()->json([

                'message' => trans('messages.deletedSuccessfully')

            ]);
        } else {

            return response()->json([

                'message' =>  trans('messages.notDeleted')

            ]);
        }
    }
}
