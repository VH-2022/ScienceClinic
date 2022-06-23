<?php



namespace App\Http\Controllers\Frontend;

use App\Helpers\PastPapersDetailHelper;
use App\Helpers\PastPapersHelper;
use App\Helpers\TutorResourcesHelper;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use App\Models\PastPapersCategory;

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
    
    public function getPastPaperData(Request $request){

        $dataGetcategory = PastPapersHelper::getAllcategory();
        $mainArray = array();
        if(count($dataGetcategory) > 0){
            foreach($dataGetcategory as $key){
                $getGetPaperData = PastPapersHelper::getDatabyCategory($key->id);
                $paperDetail = array();
                if(count($getGetPaperData) > 0){
                    foreach($getGetPaperData as $gkey){

                        $getSubjectDataByPaper = PastPapersHelper::getSubejctData($gkey->id,$gkey->paper_category_id);
                        $subjectArray = array();
                        if(count($getSubjectDataByPaper) > 0){
                            foreach($getSubjectDataByPaper as $skey){
                                $subjectArray[] = $skey;
                            }
                        }
                        $gkey->subjectData = $subjectArray;
                        $paperDetail[] = $gkey;
                    }
                }
                $key->paperArray = $paperDetail;
                if(count($paperDetail) > 0){
                    $mainArray[] = $key;
                }
                
            }
        }
        
        $data['paperData'] = $mainArray;
        return view('frontend.home.pas_papaer_resource',$data);
    }
    public function getPastPaperDetailData(Request $request,$id){
        $pastPaperdata = PastPapersHelper::getAlldataByPaperID($id);
        $mainArray = array();
        if(count($pastPaperdata) > 0){
            foreach($pastPaperdata as $key){
                $getPaperschmedata = PastPapersDetailHelper::getAlldataByPaperSchemaID($id);
                $detailArray = array();
                if(count($getPaperschmedata) > 0){
                    foreach($getPaperschmedata as $skey){
                        $detailArray[] = $skey;
                    }
                }
                $key->downloadScheme = $detailArray;
                $mainArray[] = $key;
            }
        }
        
        $data['pastPaperdetail']  = $mainArray;
        return view('frontend.home.pas_papaer_resource_detail',$data);
    }

}

