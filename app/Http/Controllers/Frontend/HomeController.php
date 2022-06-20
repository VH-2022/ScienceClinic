<?php



namespace App\Http\Controllers\Frontend;

use App\Helpers\TutorResourcesHelper;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;



class HomeController extends Controller

{

    public function index()

    {

        

        return view('frontend.home.home');

    }

    public function getELearningdata(Request $request){
        $data['getElearning'] = TutorResourcesHelper::getListwithPaginateAdmin();
        return view('frontend.home.e_learning',$data);
    }

}

