<?php

namespace App\Http\Controllers\Frontend\Tutor;

use App\Helpers\PastPapersDetailHelper;
use App\Helpers\PastPapersHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Traits\ImageUploadTrait;
use Validator;
use Session;

class TutorPastPapersController extends Controller
{
    use ImageUploadTrait;
    public $successStatus = 200;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend.tutor.past-pappers');
    }
    public function ajaxList(Request $request)
    {
        $data['page'] = $request->input('page');
        $created_date = $request->input('created_date');
        $title = $request->input('title');
        $auth = auth()->user();
        $data['query'] = PastPapersHelper::getListwithPaginateTutor($auth['id'], $title, $created_date);
        return view('frontend.tutor.past-pappers-ajax-list', $data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $auth = auth()->user();
        if (empty($auth)) {
            return redirect('/tutor-login');
        }
        $data['papersCategory'] = PastPapersHelper::getAllcategory();
        $data['subject_list'] = PastPapersHelper::getAllsubject();
        return view('frontend.tutor.addpast-pappers', $data);
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
            'paper_category_id' => 'required',
            'paper_title' => 'required',
            'subject_id' => 'required',
            'paper_sub_title' => 'required',
            'subject_paper_title.*' => 'required',
            'upload_paper.*' => 'required|mimes:jpeg,png,jpg,gif,pptx,pdf,doc,docx',
            'upload_mark_scheme.*' => 'required|mimes:jpeg,png,jpg,gif,pptx,pdf,doc,docx',
        ]);
        if ($validator->fails()) {
            return redirect("/tutor-past-papers/create")
                ->withErrors($validator, 'useredit')
                ->withInput();
        } else {
            $userId = Auth()->user()->id;

            $data_array = array(
                'paper_category_id' => $request->input('paper_category_id'),
                'paper_title' => $request->input('paper_title'),
                'subject_id' => $request->input('subject_id'),
                'paper_sub_title' => $request->input('paper_sub_title'),
            );

            $upload_paper = '';
            $upload_mark_scheme = '';

            $insert = PastPapersHelper::save($data_array);
            if ($insert) {

                $subject_paper_title = $request->subject_paper_title;
                if ($subject_paper_title != '') {

                    for ($i = 0; $i < count($subject_paper_title); $i++) {
                        $insertArray = array(
                            'paper_id' => $insert,
                            'subject_paper_title' => $request->subject_paper_title[$i],
                        );
                        if ($request->file('upload_paper') != '') {
                            $upload_paper = $this->uploadImageWithCompress($request->file('upload_paper')[$i], 'uploads/past_paper');
                        }
                        if ($upload_paper != '') {
                            $insertArray['upload_paper'] = $upload_paper;
                        }

                        if ($request->file('upload_mark_scheme') != '') {
                            $upload_mark_scheme = $this->uploadImageWithCompress($request->file('upload_mark_scheme')[$i], 'uploads/past_paper');
                        }
                        if ($upload_mark_scheme != '') {
                            $insertArray['upload_mark_scheme'] = $upload_mark_scheme;
                        }

                        $paperinsert = PastPapersDetailHelper::save($insertArray);
                    }
                }

                Session::flash('success', trans('messages.addedSuccessfully'));
                return redirect('/tutor-past-papers');
            } else {
                Session::flash('error', trans('messages.error'));
                return redirect('/tutor-past-papers/create');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $auth = auth()->user();
        if (empty($auth)) {
            return redirect('/login');
        }
        $data['papersCategory'] = PastPapersHelper::getAllcategory();
        $data['subject_list'] = PastPapersHelper::getAllsubject();
        $data['basic_details'] = PastPapersHelper::getDetailsByid($id);
        $data['paper_basic_details'] = PastPapersDetailHelper::getDetailsByid($id);
        return view('frontend.tutor.edit-past-pappers', $data);
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
        $validator = Validator::make($request->all(), [
            'paper_category_id' => 'required',
            'paper_title' => 'required',
            'subject_id' => 'required',
            'paper_sub_title' => 'required',
            'subject_paper_title.*' => 'required',
            'upload_paper.*' => 'required|mimes:jpeg,png,jpg,gif,pptx,pdf,doc,docx',
            'upload_mark_scheme.*' => 'required|mimes:jpeg,png,jpg,gif,pptx,pdf,doc,docx',
        ]);
        if ($validator->fails()) {
            return redirect("/tutor-past-papers/" . $request->input('id') . '/edit')
                ->withErrors($validator, 'useredit')
                ->withInput();
        } else {
            $data_array = array(
                'paper_category_id' => $request->input('paper_category_id'),
                'paper_title' => $request->input('paper_title'),
                'subject_id' => $request->input('subject_id'),
                'paper_sub_title' => $request->input('paper_sub_title'),
            );
            $upload_paper = '';
            $upload_mark_scheme = '';
            $update = PastPapersHelper::update($data_array, array('id' => $id));
            if ($update) {

                // delete data

                $deletedID = $request->deletedID;
                if ($deletedID != '') {
                    $deletedIDs = explode(',', $deletedID);
                    $deleteData = PastPapersDetailHelper::SoftDelete(array(), array('id' => $deletedID));
                }


                $detail_id = $request->detail_id;
                $valCount = $request->detail_id_val;
                if ($detail_id != '') {
                    for ($i = 0; $i < count($valCount); $i++) {
                        if ($valCount[$i] != '0') {
                            $updateArray = array(
                                'paper_id' => $id,
                                'subject_paper_title' => $request->subject_paper_title[$i],
                            );

                            if ($_FILES['upload_paper']['name'][$i] != '') {

                                $upload_paper = $this->uploadImageWithCompress($request->file('upload_paper')[$i], 'uploads/past_paper');
                            }
                            if ($upload_paper != '') {
                                $updateArray['upload_paper'] = $upload_paper;
                            }

                            if ($_FILES['upload_mark_scheme']['name'][$i] != '') {
                                $upload_mark_scheme = $this->uploadImageWithCompress($request->file('upload_mark_scheme')[$i], 'uploads/past_paper');
                            }
                            if ($upload_mark_scheme != '') {
                                $updateArray['upload_mark_scheme'] = $upload_mark_scheme;
                            }
                            $update = PastPapersDetailHelper::update($updateArray, array('id' => $detail_id[$i]));
                        } else if($request->upload_paper != '') {
                            $insertArray = array(
                                'paper_id' => $id,
                                'subject_paper_title' => $request->subject_paper_title[$i],
                            );
                            if ($_FILES['upload_paper']['name'][$i] != '') {
                                $upload_paper = $this->uploadImageWithCompress($request->file('upload_paper')[$i], 'uploads/past_paper');
                            }
                            if ($upload_paper != '') {
                                $insertArray['upload_paper'] = $upload_paper;
                            }

                            if ($_FILES['upload_mark_scheme']['name'][$i] != '') {
                                $upload_mark_scheme = $this->uploadImageWithCompress($request->file('upload_mark_scheme')[$i], 'uploads/past_paper');
                            }
                            if ($upload_mark_scheme != '') {
                                $insertArray['upload_mark_scheme'] = $upload_mark_scheme;
                            }

                            $paperinsert = PastPapersDetailHelper::save($insertArray);
                        }
                    }
                }
                Session::flash('success', trans('messages.updatedSuccessfully'));
                return redirect('/tutor-past-papers');
            } else {
                Session::flash('error', trans('messages.error'));
                return redirect('/tutor-past-papers/' . $id . '/edit');
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


        $update = PastPapersHelper::SoftDelete(array(), array('id' => $id));

        if ($update) {

            $delete = PastPapersDetailHelper::SoftDelete(array(), array('paper_id' => $id));

            return response()->json(['error_msg' => trans('messages.deletedSuccessfully'), 'data' => array()], 200);
        } else {
            return response()->json(['error_msg' => trans('messages.error_msg'), 'data' => array()], 500);
        }
    }
}