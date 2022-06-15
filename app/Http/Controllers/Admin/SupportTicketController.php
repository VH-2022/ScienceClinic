<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Helpers\ContactHelper;
use App\Helpers\SupportTicketHelper;

class SupportTicketController extends Controller
{
    public $successStatus =200;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('admin.support_ticket.support_ticket');
    }
    public function ajaxList(Request $request){
        $data['page'] = $request->page;
        $user_type = $request->tutor_type;
        $created_date = $request->created_date;
        $data['query'] = SupportTicketHelper::getListwithPaginate($user_type,$created_date);
        return view('admin.support_ticket.support_ticket_ajax',$data);
    }
}
