<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\MailHelper;
use App\Helpers\ParentDetailHelper;
use App\Helpers\ParentPaymentHelper;
use App\Helpers\TutorUniversityDetailHelper;
use App\Helpers\UserHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Session;

class ParentPaymentController extends Controller
{
   public function index()
   {
        return view('admin.payment.parent_payment_list');  
   }
    public function ajaxList(Request $request)
    {

        $data['page'] = $request->page;
        $name = $request->name;
      
        $created_date = $request->created_date;

        $data['query'] = ParentPaymentHelper::getListwithPaginate($name,$created_date);
       
        return view('admin.payment.parent_payment_list_ajax', $data);
    }

    
}
