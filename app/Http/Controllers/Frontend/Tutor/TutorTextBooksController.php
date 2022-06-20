<?php

namespace App\Http\Controllers\Frontend\Tutor;

use App\Helpers\SubjectHelper;
use App\Helpers\SubjectOtherSectionMasterHelper;
use App\Helpers\SubjectBannerHelper;
use App\Helpers\TextBooksHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Traits\ImageUploadTrait;
use Validator;
use Session;
class TutorTextBooksController extends Controller
{
    use ImageUploadTrait;
    public $successStatus =200;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend.tutor.tutor-textbook');
    }
    public function ajaxList(Request $request){
        $auth = auth()->user();
        $userId = $auth['id'];
        $data['page'] = $request->input('page');
        $created_date = $request->input('created_date');
        $title = $request->input('title');
        $data['query'] = TextBooksHelper::getListwithPaginateId($userId,$title,$created_date);
        return view('frontend.tutor.tutor-textbook_ajax_list',$data);
     }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $auth = auth()->user();
        if(empty($auth)){
            return redirect('/tutor-login');
        }
        $data['subject_list'] = TextBooksHelper::getAllsubject();
        return view('frontend.tutor.tutor-addtextbook',$data);
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
            'text_book_title' => 'required | max:255',
            'subject_id' => 'required',
            'text_book_description' => 'required',
            'text_book_upload' => 'required|mimes:jpeg,png,jpg,gif,pptx,pdf,doc,docx',
        ]);
        if ($validator->fails()) {
            return redirect("/tutor-text-books/create")
            ->withErrors($validator, 'useredit')
            ->withInput();
        } else {
            $text_book_upload = '';
            if ($request->file('text_book_upload') != '') {
                $text_book_upload = $this->uploadImageWithCompress($request->file('text_book_upload'), 'uploads/text_books');
            }
            $data_array = array(
                'user_id' => Auth()->user()->id,
                'text_book_title' => $request->input('text_book_title'),
                'subject_id' => $request->input('subject_id'),
                'text_book_description' => $request->input('text_book_description'),
            );
            if ($text_book_upload != '') {
                $data_array['text_book_upload'] = $text_book_upload;
            }
            $update = TextBooksHelper::save($data_array);
            if($update){
                Session::flash('success',trans('messages.addedSuccessfully'));
                return redirect('/tutor-text-books');
            }else{
                Session::flash('error',trans('messages.error'));
                return redirect('/tutor-text-books/create');
                
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
        if(empty($auth)){
            return redirect('/tutor-login');
        }
        $data['basic_details'] = TextBooksHelper::getDetailsByid($id);
        $data['subject_list'] = TextBooksHelper::getAllsubject();
        return view('frontend.tutor.tutor-edit_textbook',$data);
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
            'text_book_title' => 'required | max:255',
            'subject_id' => 'required',
            'text_book_description' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect("/tutor-text-books/".$request->input('id').'/edit')
            ->withErrors($validator, 'useredit')
            ->withInput();
        } else {
            $text_book_upload = '';
            if ($request->file('text_book_upload') != '') {
                $text_book_upload = $this->uploadImageWithCompress($request->file('text_book_upload'), 'uploads/text_books');
            }
            $data_array = array(
                'text_book_title' => $request->input('text_book_title'),
                'subject_id' => $request->input('subject_id'),
                'text_book_description' => $request->input('text_book_description'),
            );
            if ($text_book_upload != '') {
                $data_array['text_book_upload'] = $text_book_upload;
            }
            $update = TextBooksHelper::update($data_array,array('id'=>$request->input('id')));
            
           
            Session::flash('success',trans('messages.updatedSuccessfully'));
            return redirect('/tutor-text-books');
            
           
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
      
        $update = TextBooksHelper::SoftDelete(array(), array('id' => $id));

        if ($update) {
            return response()->json(['error_msg' => trans('messages.deletedSuccessfully'), 'data' => array()], 200);
        } else {
            return response()->json(['error_msg' => trans('messages.error_msg'),'data' => array()], 500);
        }
    }

    
}
