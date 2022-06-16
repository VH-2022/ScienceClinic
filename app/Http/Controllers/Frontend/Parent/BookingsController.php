<?php

namespace App\Http\Controllers\Frontend\Parent;

use App\Helpers\ParentDetailHelper;
use App\Helpers\TutorAvailabilityHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TutorAvailability;
use Illuminate\Support\Facades\Auth;

class BookingsController extends Controller
{
    public function index()
    {
        return view('frontend.parent.parent_booking');
    }
    public function getTutorAvailabilityDetails()
    {
        $userId = Auth::user()->id;
        $data = ParentDetailHelper::getBooklessondata($userId);
        return response()->json($data);
    }
    public function addTutorAvailability(Request $request)
    {

        $data = explode("T", $request->date);
        $dateTime[] = $data[0];
        $data1 = explode("+", $data[1]);
        $dateTime[] = $data1[0];
        $finalDateTime = implode(" ", $dateTime);

        $finalArr = array(
            'tutor_id' => $request->tutor_id,
            'available_datetime' => $finalDateTime,
        );
        $userData = TutorAvailabilityHelper::save($finalArr);
  
        if ($userData) {
            return response()->json(['error_msg' => "Successfully Updated", 'data' => $userData], 200);
        } else {
            return response()->json(['error_msg' => "Something Went Wrong", 'data' => ''], 400);
        }
    }
}
