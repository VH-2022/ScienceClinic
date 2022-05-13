<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\SubjectHelper;
use App\Helpers\SubjectOtherSectionMasterHelper;
use App\Helpers\SubjectBannerHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Traits\ImageUploadTrait;
use Validator;
use Session;
class SubjectController extends Controller
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
      
        return view('admin.subject.subject');
    }
    public function ajaxList(Request $request){
        $data['page'] = $request->input('page');
        $data['query'] = SubjectHelper::getListwithPaginate();
        return view('admin.subject.subject_ajax_list',$data);
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
            return redirect('/login');
        }
        return view('admin.subject.addsubject');
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
            'title' => 'required',
            'sub_title' => 'required',
            'sub_title_two' => 'required',
            'section_one_title_more' => 'required',
            'link_more' => 'required',
            'title_section_one' => 'required',
            'subject_description' => 'required',
            'title_section_two' => 'required',
            'description_section_two' => 'required',
            'subject_image' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['error_msg' => $validator->errors()->all(), 'status' => 0, 'data' => array()], $this->successStatus);
        } else {
            
            $simagesEnglish = '';
            if ($request->file('subject_image') != '') {
                $simagesEnglish = $this->uploadImageWithCompress($request->file('subject_image'), 'uploads/subject');
            }
            $data_array = array(
                'main_title' => $request->input('title'),
                'sub_title_one' => $request->input('sub_title'),
                'sub_title_two' => $request->input('sub_title_two'),
                'title' => $request->input('title_section_one'),
                'description' => $request->input('subject_description'),
            );
            if ($simagesEnglish != '') {
                $data_array['image'] = $simagesEnglish;
            }
            $update = SubjectHelper::save($data_array);
            if($update){
                $section_one_title_more = $request->input('section_one_title_more');
                if(!empty($section_one_title_more[0])){
                    foreach($section_one_title_more as $key=>$val){
                        $titleBanned = array(
                            'subject_id'=>$update,
                            'title'=>$val,
                            'link'=>$request->input('link_more')[$key]
                        );

                        SubjectBannerHelper::save($titleBanned);
                    }   
                }

                $title_section_two = $request->input('title_section_two');
                if(!empty($title_section_two[0])){
                    foreach($title_section_two as $key=>$val){
                        $titleBanned = array(
                            'subject_id'=>$update,
                            'title'=>$val,
                            'description'=>$request->input('description_section_two')[$key]
                        );
                        
                        SubjectOtherSectionMasterHelper::save($titleBanned);
                    }   
                }
                Session::flash('success',trans('messages.addedSuccessfully'));
                return redirect('/subject-master');
            }else{
                Session::flash('error',trans('messages.error'));
                return redirect('/subject-master/create');
                
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
            return redirect('/login');
        }
        $data['basic_details'] = SubjectHelper::getDetailsByid($id);
        $data['bannerSection'] = SubjectBannerHelper::getDetailsBySubjectId($id);
        $data['SectionTwo'] = SubjectOtherSectionMasterHelper::getDetailsBySubjectId($id);
        return view('admin.subject.edit_subject',$data);
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
            'title' => 'required',
            'sub_title' => 'required',
            'sub_title_two' => 'required',
            'section_one_title_more' => 'required',
            'link_more' => 'required',
            'title_section_one' => 'required',
            'subject_description' => 'required',
            'title_section_two' => 'required',
            'description_section_two' => 'required',
        
        ]);
        if ($validator->fails()) {
            return response()->json(['error_msg' => $validator->errors()->all(), 'status' => 0, 'data' => array()], $this->successStatus);
        } else {
            
            $simagesEnglish = '';
            if ($request->file('subject_image') != '') {
                $simagesEnglish = $this->uploadImageWithCompress($request->file('subject_image'), 'uploads/subject');
            }
            $data_array = array(
                'main_title' => $request->input('title'),
                'sub_title_one' => $request->input('sub_title'),
                'sub_title_two' => $request->input('sub_title_two'),
                'title' => $request->input('title_section_one'),
                'description' => $request->input('subject_description'),
            );
            if ($simagesEnglish != '') {
                $data_array['image'] = $simagesEnglish;
            }
            $update = SubjectHelper::update($data_array,array('id'=>$request->input('id')));
            
            $section_one_title_more = $request->input('section_one_title_more');
            if(!empty($section_one_title_more[0])){
                SubjectBannerHelper::SoftDelete(array('subject_id'=>$request->input('id')));
                foreach($section_one_title_more as $key=>$val){
                    $titleBanned = array(
                        'subject_id'=>$request->input('id'),
                        'title'=>$val,
                        'link'=>$request->input('link_more')[$key]
                    );

                    SubjectBannerHelper::save($titleBanned);
                }   
            }

            $title_section_two = $request->input('title_section_two');
            if(!empty($title_section_two[0])){
                SubjectOtherSectionMasterHelper::SoftDelete(array(),array('subject_id'=>$request->input('id')));
                foreach($title_section_two as $key=>$val){
                    $titleBanned = array(
                        'subject_id'=>$request->input('id'),
                        'title'=>$val,
                        'description'=>$request->input('description_section_two')[$key]
                    );
                    
                    SubjectOtherSectionMasterHelper::save($titleBanned);
                }   
            }
            Session::flash('success',trans('messages.updatedSuccessfully'));
            return redirect('/subject-master');
            
           
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
        //
    }

    
}
