<?php



namespace App\Http\Controllers\Frontend;

use App\Helpers\SubjectHelper;
use App\Helpers\TutorLevelHelper;
use App\Helpers\UserHelper;
use App\Http\Controllers\Controller;


class TutorListController extends Controller

{
    public function index()
    {
        $data['title'] = 'Tutor List';
        $data['tutorData'] = UserHelper::getTutors();
        $data['allSubjectsData'] = SubjectHelper::getAllSubjectList();
        $data['allLevelData'] = TutorLevelHelper::getAllTutorList();
    //    dd($data);
        return view('frontend.tutor_list.tutor-list', $data);
    }
}