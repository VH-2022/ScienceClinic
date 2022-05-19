<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use App\Http\Traits\ImageUploadTrait;
use App\Helpers\TutorDetailHelper;
use App\Helpers\UserHelper;
use App\Helpers\SubjectHelper;
use App\Helpers\TutorLevelHelper;
use App\Helpers\TutorUniversityDetailHelper;
use App\Helpers\TutorSubjectDetailHelper;
use App\Helpers\TutorLevelDetailHelper;
class BecomeTutorController extends Controller
{
    public $successStatus = 200;
    public $validationStatus = 400;
    public $errorStatus = 500;
    public $unauthorizedStatus = 401;
    public $notFoundStatus = 404;
    public $alreadyExistStatus = 409;
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['subject_list'] = SubjectHelper::getAllSubjectList();
        $data['tutor_level_list'] = TutorLevelHelper::getAllTutorList();
        return view('frontend.become_tutor.create',$data);
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
       
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'address1' => 'required',
            'address2' => 'required',
            'address3' => 'required',
            'city' => 'required',
            'postcode' => 'required',
            'bio' => 'required',
            'profile_image' => 'required',
            'dbsdisclosure' => 'required',
            'exprienceinuk' => 'required',
            'tutorexperienceinuk' => 'required',
            'paytax' => 'required',
            'subject' => 'required',
            'level' => 'required',
            'university' => 'required',
            'qualification' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect("/become-tutor")
            ->withErrors($validator, 'useredit')
            ->withInput();
        } else {
            $image = '';
            if ($request->file('profile_image') != '') {
                $image = $this->uploadImageWithCompress($request->file('profile_image'), 'uploads/user');
            }
               
            
            $data_array = array(
                'first_name' => $request->name,
                'email' => $request->email,
                'mobile_id' => $request->mobile,
                'address1' => $request->address1,
                'address2' => $request->address2,
                'address3' => $request->address3,
                'city' => $request->city,
                'postcode' => $request->postcode,
                'bio' => $request->bio,
                'profile_photo' => $image,
            );
            
            $data = UserHelper::save($data_array);
            
        
            if ($data) {
                $document = '';
                if($request->dbsdisclosure =='Yes'){
                    
                    if ($request->file('document_pdf') != '') {
                        $document = $this->uploadImageWithCompress($request->file('document_pdf'), 'uploads/user');
                    }
                }
                $tutorDetails = array(
                    'tutor_id' => $data,
                    'dbs_disclosure' => $request->dbsdisclosure,
                    'experience_in_uk' => $request->exprienceinuk,
                    'total_experience_in_uk' => $request->tutorexperienceinuk,
                    'pay_tex' => $request->paytax,
                    'document'=> $document
                );
                TutorDetailHelper::save($tutorDetails);

                $university = $request->input('university');
                if(!empty($university)){
                    foreach($university as $key=>$val){
                        $document_image ='';
                        if ($request->file('document_certi') != '') {
                            $document_image = $this->uploadImageWithCompress($request->file('document_certi')[$key], 'uploads/user/certificate');
                        }
                        $tutorUniversityDetails = array(
                            'tutor_id' => $data,
                            'university_name' => $val,
                            'qualification' =>$request->input('qualification')[$key],
                            'document_image'=>$document_image
                        );

                        TutorUniversityDetailHelper::save($tutorUniversityDetails);
                    }
                }


                $subject = $request->input('subject');
                if(!empty($subject)){
                    foreach($subject as $key=>$vals){
                       
                        $tutorSubjectDetails = array(
                            'tutor_id' => $data,
                            'subject_id' => $vals,
                           
                        );

                        TutorSubjectDetailHelper::save($tutorSubjectDetails);
                    }
                }
                
                $level = $request->input('level');
                if(!empty($level)){
                    foreach($level as $key=>$vals){
                       
                        $tutorLevelDetails = array(
                            'tutor_id' => $data,
                            'level_id' => $vals,
                           
                        );

                        TutorLevelDetailHelper::save($tutorLevelDetails);
                    }
                }

                Session::flash('success', trans('messages.addedSuccessfully'));
                return redirect('/become-tutor');
            } else {
                Session::flash('error', trans('messages.error'));
                return redirect('/become-tutor');
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
        //
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

    public static function checkEmail(Request $request)
    {
        // dd($request->all());
        $email = $request->email;
        $data =  User::where('email', $email)->where('deleted_at', NULL)->first();
        if (isset($data)) {
            return response()->json(['status' => 1]);
        } else {
            return response()->json(['status' => 0]);
        }
    }
}
