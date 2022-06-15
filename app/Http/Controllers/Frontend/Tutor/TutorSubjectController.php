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
        $this->data['subject'] = SubjectHelper::getList();
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
    public function edit(Request $request)
    {
        $id = $request->id;
        $data = TutorLevelDetailHelper::getData($id);
        return json_encode($data);
    }
}
