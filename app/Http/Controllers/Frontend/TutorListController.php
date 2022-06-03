<?php



namespace App\Http\Controllers\Frontend;

use App\Helpers\UserHelper;
use App\Http\Controllers\Controller;


class TutorListController extends Controller

{
    public function index()
    {
        $data['title'] = 'Tutor List';
        $data['tutorData'] = UserHelper::getTutors();
        return view('frontend.tutor_list.tutor-list', $data);
    }
}