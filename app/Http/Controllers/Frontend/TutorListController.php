<?php



namespace App\Http\Controllers\Frontend;

use App\Helpers\SubjectHelper;
use App\Helpers\TutorLevelHelper;
use App\Helpers\UserHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TutorListController extends Controller

{
    public function index(Request $request)
    {   
        $data['title'] = 'Tutor List';
        $data['allSubjectsData'] = SubjectHelper::getAllSubjectList();
        $data['allLevelData'] = TutorLevelHelper::getAllTutorList();
        return view('frontend.tutor_list.tutor-list', $data);
    }
    public function ajaxList(Request $request){
        if ($request->input('page')) {
            $this->data['page'] = $request->input('page');
        } else {
            $this->data['page'] = 1;
        }
        $this->data['tutorList'] = UserHelper::getTutors();
        return view('frontend.tutor_list.tutor-list-ajax', $this->data);
    }
    public function ajaxFilterList(Request $request){
        $subject =  $request->input('subject');
        $level =  $request->input('level');
        if ($request->input('page')) {
            $this->data['page'] = $request->input('page');
        } else {
            $this->data['page'] = 1;
        }
        $this->data['tutorList'] = UserHelper::filterTutors($subject, $level);
        return view('frontend.tutor_list.tutor-list-ajax', $this->data);
    }
}