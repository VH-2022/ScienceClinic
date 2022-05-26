<?php

namespace App\Http\Controllers\Admin;

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
}
