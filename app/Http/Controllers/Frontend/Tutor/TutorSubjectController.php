<?php



namespace App\Http\Controllers\Frontend\Tutor;

use App\Helpers\SubjectHelper;
use App\Helpers\TutorLevelDetailHelper;
use App\Helpers\TutorLevelHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class TutorSubjectController extends Controller

{
    public $successStatus = 200;
    public function index()
    {
        $auth = Auth::guard('web')->user();
        $id = $auth['id'];
        $this->data['subject'] = SubjectHelper::getAllSubjectList();
        $this->data['level'] = TutorLevelHelper::getAllTutorList();
        $this->data['tutorData'] = $tutorData = TutorLevelDetailHelper::getListTutor($id);
        foreach ($tutorData as $val) {
            $this->data['selectedSubject'][] = $val->subject_id;
            $this->data['selectedLevel'][] = $val->level_id;
        }
        return view('frontend.tutor.tutor-subject', $this->data);
    }
    public function store(Request $request)
    {
        $rules = array(
            'main_subject' => 'required',
            'level' => 'required'
        );
        $messsages = array(
            'main_subject.required' => 'Please select Subject',
            'level.required' => 'Please select Level'
        );
        $validator = Validator::make($request->all(), $rules, $messsages);
        if ($validator->fails()) {
            return redirect("/tutor-subject?addpopup=1")
                ->withErrors($validator, 'subject')
                ->withInput();
        } else {
            $auth = Auth::guard('web')->user();
            $id = $auth['id'];
            $level = $request->input('level');
            $subject = $request->input('main_subject');
            $tutorLevelDetails = array(
                'tutor_id' => $id,
                'level_id' => $level,
                'subject_id' => $subject,
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => $id
            );
            $insert = TutorLevelDetailHelper::save($tutorLevelDetails);
            if ($insert) {
                Session::flash('success', trans('messages.addedSuccessfully'));
                return redirect('tutor-subject');
            } else {
                Session::flash('error', trans('messages.error'));
                return redirect('tutor-subject');
            }
        }
    }
    public function ajaxList(Request $request)
    {
        $auth = Auth::guard('web')->user();
        $id = $auth['id'];
        $data['page'] = $request->page;
        $data['query'] = TutorLevelDetailHelper::getListTutorWithPaginate($id);
        return view('frontend.tutor.tutor-subject-ajax', $data);
    }
    public function onlineAjaxList(Request $request)
    {
        $auth = Auth::guard('web')->user();
        $id = $auth['id'];
        $data['page'] = $request->page;
        $data['query'] = TutorLevelDetailHelper::getListOnlineSubjectWithPaginate($id);
        return view('frontend.tutor.tutor-online-subject-ajax', $data);
    }
    public function edit(Request $request)
    {
        $id = $request->id;
        $data = TutorLevelDetailHelper::getData($id);
        return json_encode($data);
    }
    public function editOnlineSubject(Request $request)
    {
        $id = $request->id;
        $data = TutorLevelDetailHelper::getOnlineSubjectData($id);
        return json_encode($data);
    }
    public function checkData(Request $request)
    {
        $subjectId = $request->name;
        $levelId = $request->level;
        $tutorId = $request->id;
        $mainId = $request->mainId;
        $checkData = TutorLevelDetailHelper::checkData($subjectId, $levelId, $tutorId, $mainId);
        if ($checkData) {
            return 1;
        } else {
            return 0;
        }
    }
    public function update(Request $request)
    {
        $subjectId = $request->main_subject_edit;
        $levelId = $request->level_edit;
        $mainId = $request->main_id_edit;
        $rules = array(
            'main_subject_edit' => 'required',
            'level_edit' => 'required'
        );
        $messsages = array(
            'main_subject_edit.required' => 'Please select Subject',
            'level_edit.required' => 'Please select Level'
        );
        $validator = Validator::make($request->all(), $rules, $messsages);
        if ($validator->fails()) {
            return redirect("/tutor-subject?editpopup=1&id=" . $mainId)
                ->withErrors($validator, 'edit')
                ->withInput();
        } else {
            $auth = Auth::guard('web')->user();
            $id = $auth['id'];
            $updateArray = array(
                'subject_id' => $subjectId,
                'level_id' => $levelId,
                'updated_by' => $id,
                'updated_at' => date('Y-m-d H:i:s')
            );
            $update = TutorLevelDetailHelper::updateSubject($mainId, $updateArray);
            if ($update) {
                Session::flash('success', trans('messages.updatedSuccessfully'));
                return redirect('tutor-subject');
            } else {
                Session::flash('error', trans('messages.error'));
                return redirect('tutor-subject');
            }
        }
    }
    public function delete(Request $request)
    {
        $id = $request->id;
        $update = TutorLevelDetailHelper::SoftDelete(array(), array('id' => $id));
        if ($update) {
            Session::flash('success', trans('messages.deletedSuccessfully'));
        } else {
            Session::flash('error', trans('messages.error'));
        }
    }
}
