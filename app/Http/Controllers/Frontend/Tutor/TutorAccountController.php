<?php



namespace App\Http\Controllers\Frontend\Tutor;

use App\Helpers\TutorBankAccountDetailsHelper;
use App\Helpers\TutorDetailHelper;
use App\Helpers\TutorUniversityDetailHelper;
use App\Helpers\UserHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Traits\ImageUploadTrait;
use App\Models\TutorBankAccountDetails;
use App\Models\TutorDetail;
use App\Models\TutorUniversityDetail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class TutorAccountController extends Controller

{
    public $successStatus = 200;
    use ImageUploadTrait;
    public function index()
    {
        $user = Auth::guard('web')->user();
        $userId = $user['id'];
        $data['getQualificatiosData'] = TutorUniversityDetailHelper::getListwithPaginate($userId);
        $data['getUniversityDetails'] = TutorUniversityDetailHelper::getTutorUniversityDetailsById($userId);
        return view('frontend.tutor.tutor-account', $data);
    }
    public function updateProfile(Request $request)
    {
        $rules = array(
            'name' => 'required | max:30',

            'email' => 'required | email',

            'mobile' => 'required | numeric',

            'address1' => 'required | max:255',

            'address2' => 'required | max:255',

            'address3' => 'required | max:255',

            'city' => 'required | max:255',

            'postcode' => 'required | max:6',

            'bio' => 'required',

        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors(), 'status' => 0], 400);
        } else {
            $auth = Auth()->user();
            $data_array = array(

                'first_name' => $request->name,

                'email' => $request->email,

                'mobile_id' => $request->mobile,

                'address1' => $request->address1,

                'address2' => $request->address2,

                'address3' => $request->address3,

                'city' => $request->city,

                'postcode' => $request->postcode,

                'bio' => $request->bio

            );
            $data = UserHelper::update($data_array, array('id' => $auth->id));
            $university = $request->university;
            
            if (!empty($university)) {
                $deleteUniversity = TutorUniversityDetailHelper::deleteUniversity($auth->id);

                foreach ($university as $key => $val) {
                    $document_image = '';

                    if(isset($request->file('document_certi')[$key])){
                        $document_image = $this->uploadImageWithCompress($request->file('document_certi')[$key], 'uploads/user/certificate');
                    }else{
                        $document_image = $request->odocument_certi[$key];
                    }
                    

                    $tutorUniversityDetails = array(

                        'tutor_id' => $auth->id,

                        'university_name' => $val,

                        'qualification' => $request->input('qualification')[$key],

                        'document_image' => $document_image

                    );



                    TutorUniversityDetailHelper::save($tutorUniversityDetails);
                }
            }

            if ($data) {
                return response()->json(['success_msg' => trans('messages.updatedSuccessfully'), 'status' => 0, 'data' => array($data_array)], $this->successStatus);
            } else {
                return response()->json(['error_msg' => "", 'status' => 1, 'data' => array()], $this->successStatus);
            }
        }
    }
    public function checkEmail(Request $request)
    {
        $email = $request->email;
        $data =  UserHelper::checkDuplicateEmailTutor($email);
        if ($data != 0) {
            return response()->json(['status' => 1]);
        } else {
            return response()->json(['status' => 0]);
        }
    }
    public function checkCurrentPassword(Request $request)
    {
        $pwd = $request->pwd;
        $auth = Auth::guard('web')->user();
        $password = $auth['password'];
        if (Hash::check($pwd, $password)) {
            return response()->json(['status' => 0]);
        } else {
            return response()->json(['status' => 1]);
        }
    }
    public function updatePassword(Request $request)
    {
        $auth  = auth()->user();
        $rules = array(
            'current_password' => 'required',
            'new_password' => 'required|min:6|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!@$#%&*]).{6,}$/',
            'confirmation_password' => 'required|same:new_password|min:6|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!@$#%&*]).{6,}$/',
        );
        $messsages = array(
            'new_password.regex' => 'Password should include 6 charaters, alphabets, numbers and special characters',
            'confirmation_password.regex' => 'Password should include 6 charaters, alphabets, numbers and special characters'
        );
        $validator = Validator::make($request->all(), $rules, $messsages);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors(), 'status' => 0], 400);
        } else {
            $user_id = $auth['id'];
            $user = User::findOrFail($user_id);
            if ($request->input('new_password') == $request->input('confirmation_password')) {

                $user->fill([

                    'password' => Hash::make($request->input('new_password'))

                ])->save();

                return response()->json(['success_msg' => trans('messages.updatedSuccessfully'), 'status' => 1, 'data' => array()], $this->successStatus);
            } else {
                return response()->json(['error_msg' => trans('messages.errormsg'), 'status' => 0, 'data' => array()], 400);
            }
        }
    }

    public function storeAccountDetails(Request $request)
    {
        
        $rules = array(
            'account_holder_name' => 'required | max:30',

            'bank_name' => 'required | max:30',

            'account_number' => 'required | numeric',

            'sort_code' => 'required',

        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors(), 'status' => 0], 400);
        } else {
            $auth = Auth()->user();
 
            $data_array = array(

                'account_holder_name' => $request->account_holder_name,

                'bank_name' => $request->bank_name,

                'bank_account_number' => $request->account_number,

                'bank_sort_code' => $request->sort_code,
                'tutor_id' => $auth->id,
            );
          $count = TutorBankAccountDetailsHelper::getTutors($auth->id); 
           if(empty($count))
           {
               $data = TutorBankAccountDetailsHelper::save($data_array);
           }else{
                $data = TutorBankAccountDetailsHelper::update($data_array,array('tutor_id' => $auth->id));
           }

            if ($data) {
                return response()->json(['success_msg' => trans('messages.updatedSuccessfully'), 'status' => 0, 'data' => array($data_array)], $this->successStatus);
            } else {
                return response()->json(['error_msg' => "", 'status' => 1, 'data' => array()], $this->successStatus);
            }
        }
    }
    public function getTutorBankDetails()
    {
        $auth = Auth()->user();
        $data = TutorBankAccountDetailsHelper::getTutors($auth->id);
        return response()->json($data);
    }
}
