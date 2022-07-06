<?php

namespace App\Http\Controllers\Frontend\Parent;

use App\Helpers\FeedbackHelper;
use App\Helpers\ParentDetailHelper;
use App\Helpers\UserHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FeedbackController extends Controller
{
   public function index()
   {
      $parentId = Auth::user()->id;
      $parentDetails['data'] = ParentDetailHelper::getParentsByBookings($parentId);
      return view('frontend.parent.parent_feedback', $parentDetails);
   }

   public function feedbackForm($uniqueId)
   {
      $parentId = Auth::user()->id;
      $tutorData['unique_id'] = $uniqueId;
      return view('frontend.parent.tutor_feedback', $tutorData);
   }
   public function submitParentFeedback(Request $request)
   {

      $parentId = Auth()->user()->id;
    $parentDetaials = ParentDetailHelper::getParentDetailsById($request->unique_id);
      $validator = Validator::make($request->all(), [
         'description' => 'required',
         'subject' => 'required',
         'outcome' => 'required |max:15',
         'rating' => 'required',
      ]);

      if ($validator->fails()) {

         return response()->json(['message' => $validator->errors(), 'status' => 0], 400);
      } else {
         $feedbackData = FeedbackHelper::getFeedbackDataById($request->unique_id);

         $data = array(
            'descriptions' => $request->description,
            'subject' => $request->subject,
            'outcome' => $request->outcome,
            'rating' => $request->rating,
            'inquiry_id' => $request->unique_id,
            'parent_id' => $parentId,
            'subject_id' => $parentDetaials->subject_id,
         );
         if (empty($feedbackData)) {
            $userData = FeedbackHelper::save($data);
         } else {
            $userData = FeedbackHelper::update($data, array('id' => $feedbackData->id));
         }
         if ($userData) {
            return response()->json(['error_msg' => "Successfully updated", 'data' => $data], 200);
         } else {
            return response()->json(['error_msg' => "Something went wrong", 'data' => ''], 400);
         }
      }
   }
   public function getFeedback(Request $request)
   {
      $feedbackData = FeedbackHelper::getFeedbackDataById($request->unique_id);
      return response()->json($feedbackData);
   }
}
