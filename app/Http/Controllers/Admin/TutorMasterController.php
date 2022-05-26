<?php



namespace App\Http\Controllers\Admin;

use App\Helpers\TutorDetailHelper;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\User;

use App\Helpers\UserHelper;

use App\Helpers\TutorMasterHelper;

use App\Helpers\TutorUniversityDetailHelper;

use App\Helpers\TutorSubjectDetailHelper;

use App\Helpers\TutorLevelDetailHelper;

use Validator;

use Session;



class TutorMasterController extends Controller

{

    public $successStatus = 200;

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index()

    {

        $totur = User::get();

        return view('admin.tutor.tutor');
    }

    public function ajaxList(Request $request)
    {

        $data['page'] = $request->page;

        $first_name = $request->first_name;

        $email = $request->email;

        $mobile = $request->mobile_id;

        $created_date = $request->created_date;

        $data['query'] = TutorMasterHelper::getListwithPaginate($first_name, $email, $mobile, $created_date);

        return view('admin.tutor.tutor_ajax', $data);
    }

    public function destroy($id)

    {

        $update = TutorMasterHelper::SoftDelete(array(), array('id' => $id));

        if ($update) {

            return response()->json([

                'message' => trans('messages.deletedSuccessfully')

            ]);
        } else {

            return response()->json([

                'message' =>  trans('messages.notDeleted')

            ]);
        }
    }

    public function show($id)

    {

        $data['tutor'] = TutorMasterHelper::getDetailsById($id);

        if (isset($data['tutor']->id)) {

            return view('admin.tutor.tutor_view', $data);
        } else {

            abort(404);
        }
    }

    public function getUniversityDetails(Request $request)
    {

        $data['page'] = $request->page;



        $tutor_id = $request->tutor_id;

        $data['query'] = TutorUniversityDetailHelper::getListwithPaginate($tutor_id);

        return view('admin.tutor.tutor_university_list', $data);
    }

    public function getSubjectDetails(Request $request)
    {

        $data['page'] = $request->page;

        $tutor_id = $request->tutor_id;

        $data['query'] = TutorSubjectDetailHelper::getListwithPaginate($tutor_id);

        return view('admin.tutor.tutor_subject_list', $data);
    }

    public function getLevelDetails(Request $request)
    {

        $data['page'] = $request->page;

        $tutor_id = $request->tutor_id;

        $data['query'] = TutorLevelDetailHelper::getListwithPaginate($tutor_id);



        return view('admin.tutor.tutor_level_list', $data);
    }

    public function getOtherDetails(Request $request)
    {
        $data['page'] = $request->page;

        $tutor_id = $request->tutor_id;

        $data['query'] = TutorDetailHelper::getOtherListwithPaginate($tutor_id);

        return view('admin.tutor.tutor_other_list', $data);
    }



    public function changeStatus(Request $request)
    {

        $query = UserHelper::updateStatus($request->id, $request->status);

        if ($query) {

            return response()->json(['error_msg' => trans('messages.updatedSuccessfully'), 'data' => array('status' => $request->status)], 200);
        } else {

            return response()->json(['error_msg' => trans('messages.error'), 'data' => array()], 500);
        }
    }
}
