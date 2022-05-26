<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Helpers\ContactHelper;

class ContactListController extends Controller
{
    public $successStatus =200;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('admin.contact.contact');
    }
    public function ajaxList(Request $request){
        $data['page'] = $request->page;
        $name = $request->name;
        $phone_no = $request->phone_no;
        $tutor_type = $request->tutor_type;
        $email = $request->email;
        $created_date = $request->created_date;
        $data['query'] = ContactHelper::getListwithPaginate($name,$phone_no,$tutor_type,$email,$created_date);
        return view('admin.contact.contact-ajax',$data);
    }
}
