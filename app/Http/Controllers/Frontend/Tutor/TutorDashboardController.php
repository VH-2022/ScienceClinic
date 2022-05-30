<?php



namespace App\Http\Controllers\Frontend\Tutor;

use App\Http\Controllers\Controller;


class TutorDashboardController extends Controller

{

    public function index(){

        return view('frontend.tutor.tutor-dashboard');

    }

}