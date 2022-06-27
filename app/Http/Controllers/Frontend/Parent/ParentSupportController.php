<?php

namespace App\Http\Controllers\Frontend\Parent;

use App\Helpers\SupportTicketHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class ParentSupportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = "Support Ticket";
        return view('frontend.parent.parent-support', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'message' => 'required'
        );
        $messsages = array(
            'message.required' => 'Please enter Message'
        );
        $validator = Validator::make($request->all(), $rules, $messsages);
        if ($validator->fails()) {
            return redirect("/parent-support-ticket?addpopup=1")
                ->withErrors($validator, 'add')
                ->withInput();
        } else {
            $auth = Auth::user();
            $id = $auth['id'];
            $message = $request->input('message');
            $tutorTicketDetails = array(
                'user_id' => $id,
                'support_msg' => $message,
                'created_by' => $id,
            );
            $insert = SupportTicketHelper::save($tutorTicketDetails);
            if ($insert) {
                Session::flash('success', trans('messages.addedSuccessfully'));
                return redirect('parent-support-ticket');
            } else {
                Session::flash('error', trans('messages.error'));
                return redirect('parent-support-ticket');
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
        $data = SupportTicketHelper::getData($id);
        return json_encode($data);
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
        $id = $request->editid;
        $rules = array(
            'message_edit' => 'required',
        );
        $messsages = array(
            'message_edit.required' => 'Please enter Message'
        );
        $validator = Validator::make($request->all(), $rules, $messsages);
        if ($validator->fails()) {
            return redirect("/parent-support-ticket?editpopup=1&id=" . $id)
                ->withErrors($validator, 'edit')
                ->withInput();
        } else {
            $auth = Auth::user();
            $authId = $auth['id'];
            $title = $request->input('message_edit');
            $tutorTicketDetails = array(
                'user_id' => $authId,
                'support_msg' => $title,
                'updated_by' => $authId,
                'updated_at' => date('Y-m-d H:i:s')
            );
            $insert = SupportTicketHelper::update($id, $tutorTicketDetails);
            if ($insert) {
                Session::flash('success', trans('messages.updatedSuccessfully'));
                return redirect('parent-support-ticket');
            } else {
                Session::flash('error', trans('messages.error'));
                return redirect('parent-support-ticket');
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
        $update = SupportTicketHelper::SoftDelete(array(), array('id' => $id));
        if ($update) {
            Session::flash('success', trans('messages.deletedSuccessfully'));
        } else {
            Session::flash('error', trans('messages.error'));
        }
    }

    public function supportAjaxList(Request $request)
    {
        $auth = Auth::user();
        $id = $auth['id'];
        $data['page'] = $request->page;
        $data['query'] = SupportTicketHelper::getTutorListWithPaginate($id);
        return view('frontend.parent.parent-support-ajax', $data);
    }
    public function edit(Request $request)
    {
        $id = $request->id;
        $data = SupportTicketHelper::getData($id);
        return json_encode($data);
    }
}
