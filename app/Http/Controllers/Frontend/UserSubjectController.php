<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Helpers\SubjectHelper;
use App\Helpers\SubjectBannerHelper;
use App\Helpers\SubjectOtherSectionMasterHelper;
class UserSubjectController extends Controller
{
    public function index($id)
    {
        $data['query'] = SubjectHelper::getDetailsByEncryptId($id);
        if(isset($data['query']->id) && $data['query']->id !=''){
          
            $data['bannerSection'] = SubjectBannerHelper::getDetailsBySubjectId($data['query']->id);
            $data['SectionTwo'] = SubjectOtherSectionMasterHelper::getDetailsBySubjectId($data['query']->id);
            return view('frontend.user_subject.user_subject',$data);
        }else{
            abort(404);
        }
        
    }
    public function subSubjectDetails($id)
    {
        $data['query'] = SubjectHelper::getDetailsByEncryptId($id);
       
        if(isset($data['query']->id) && $data['query']->id !=''){
          
            $data['bannerSection'] = SubjectBannerHelper::getDetailsBySubjectId($data['query']->id);
            $data['SectionTwo'] = SubjectOtherSectionMasterHelper::getDetailsBySubjectId($data['query']->id);
            return view('frontend.user_subject.user_sub_subject',$data);
        }else{
            abort(404);
        }
    }

    
}
