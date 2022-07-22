<?php

namespace App\Http\Controllers\Frontend\Tutor;

use App\Helpers\TutorResourcesHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Traits\ImageUploadTrait;
use Illuminate\Support\Facades\Session;

class TutorResourceController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'title' => 'required|max:255',
            'description' => 'required',
            'document' => 'required|mimes:jpeg,png,jpg,gif,ppt,pdf,doc,docx'
        );
        $messsages = array(
            'title.required' => 'Please select Title',
            'title.max' => 'Please enter Title only 255 Characters',
            'description.required' => 'Please enter Description',
            'document.required' => 'Please upload Document',
            'document.mimes' => 'Document must be Type!! Like: JPEG, PNG, JPG, GIF, PPT, PDF, DOCX, and DOC'
        );
        $validator = Validator::make($request->all(), $rules, $messsages);
        if ($validator->fails()) {
            return redirect("/tutor-subject?addpopupresource=1")
                ->withErrors($validator, 'add')
                ->withInput();
        } else {
            $auth = Auth::guard('web')->user();
            $id = $auth['id'];
            $title = $request->input('title');
            $description = $request->input('description');
            if ($request->file('document') != '') {
                $document = $this->uploadImageWithCompress($request->file('document'), 'uploads/resource');
            }
            $tutorResourceDetails = array(
                'user_id' => $id,
                'view_flag' => 1,
                'title' => $title,
                'description' => $description,
                'upload_data' => $document,
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => $id,
            );
            $insert = TutorResourcesHelper::save($tutorResourceDetails);
            if ($insert) {
                Session::flash('success', trans('messages.addedSuccessfully'));
                return redirect('tutor-subject');
            } else {
                Session::flash('error', trans('messages.error'));
                return redirect('tutor-subject');
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
        $data = TutorResourcesHelper::getData($id);
        return json_encode($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $id = $request->user_id;
        $rules = array(
            'title_edit' => 'required|max:255',
            'description_edit' => 'required',
            'document_edit' => 'mimes:jpeg,png,jpg,gif,ppt,pdf,doc,docx'
        );
        $messsages = array(
            'title_edit.required' => 'Please select Title',
            'title_edit.max' => 'Please enter Title only 255 Characters',
            'description_edit.required' => 'Please enter Description',
            'document_edit.mimes' => 'Document must be Type!! Like: JPEG, PNG, JPG, GIF, PPT, PDF, DOCX, and DOC'
        );
        $validator = Validator::make($request->all(), $rules, $messsages);
        if ($validator->fails()) {
            return redirect("/tutor-subject?editpopupresource=1&id=" . $id)
                ->withErrors($validator, 'edit')
                ->withInput();
        } else {
            $auth = Auth::guard('web')->user();
            $authId = $auth['id'];
            $title = $request->input('title_edit');
            $description = $request->input('description_edit');
            $document = '';
            if ($request->file('document_edit') != '') {
                $document = $this->uploadImageWithCompress($request->file('document_edit'), 'uploads/resource');
            }
            $tutorResourceDetails = array(
                'user_id' => $authId,
                'title' => $title,
                'description' => $description,
                'updated_at' => date('Y-m-d H:i:s'),
                'updated_by' => $authId,
            );
            if($document !=''){
                $tutorResourceDetails['upload_data'] = $document;
            }
            $insert = TutorResourcesHelper::update($id, $tutorResourceDetails);
            if ($insert) {
                Session::flash('success', trans('messages.updatedSuccessfully'));
                return redirect('tutor-subject');
            } else {
                Session::flash('error', trans('messages.error'));
                return redirect('tutor-subject');
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
        $update = TutorResourcesHelper::SoftDelete(array(), array('id' => $id));
        if ($update) {
            Session::flash('success', trans('messages.deletedSuccessfully'));
        } else {
            Session::flash('error', trans('messages.error'));
        }
    }

    public function resourceAjaxList(Request $request)
    {
        $auth = Auth::guard('web')->user();
        $id = $auth['id'];
        $data['page'] = $request->page;
        $data['query'] = TutorResourcesHelper::getListWithPaginate($id);
        return view('frontend.tutor.tutor-resource-ajax', $data);
    }
}
