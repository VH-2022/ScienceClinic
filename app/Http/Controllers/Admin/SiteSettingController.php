<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\MailHelper;
use App\Helpers\ParentDetailHelper;
use App\Helpers\ParentPaymentHelper;
use App\Helpers\SiteSettingHelper;
use App\Helpers\TutorUniversityDetailHelper;
use App\Helpers\UserHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Session;

class SiteSettingController extends Controller
{
   public function index()
   {
        $data['sitesetting'] = SiteSettingHelper::getSettingdata();
        return view('admin.site_setting',$data);  
   }

   public function update(Request $request, $id){
        $request->validate([
            'commission_value' => 'required',
        ]);
        
        $data_array = array(
            'commission_value' => $request->commission_value
        );
        
        $dataSetting = SiteSettingHelper::getSettingdata();
        if($dataSetting){
            $update = SiteSettingHelper::update($data_array,array('id'=>$request->id));
        }else{
            $update = SiteSettingHelper::save($data_array);
        }

        
        if ($update) {
            Session::flash('success',trans('messages.updatedSuccessfully'));
            return redirect()->route('site-setting.index');
        }
        else {
            Session::flash('error', trans('messages.error'));
            return redirect()->back();
        }
   }
}
