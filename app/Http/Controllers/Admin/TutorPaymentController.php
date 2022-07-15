<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\MailHelper;
use App\Helpers\ParentDetailHelper;
use App\Helpers\ParentPaymentHelper;
use App\Helpers\TutorUniversityDetailHelper;
use App\Helpers\UserHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Session;

class TutorPaymentController extends Controller
{
    public function index()
    {
        return view('admin.tutor.tutor_payment_list');
    }

    public function tutorUnpaidList()
    {
        return view('admin.tutor.tutor_unpaid_payment_list');
    }
    public function ajaxList(Request $request)
    {
        $data['page'] = $request->page;
        $name = $request->name;

        $created_date = $request->created_date;

        $data['query'] = ParentPaymentHelper::getPaidListwithPaginate($name, $created_date);

        return view('admin.tutor.tutor_payment_list_ajax', $data);
    }

    public function tutorPayamount(Request $request)
    {

        $id = $request->id;
        $updateArray = array('tutor_pay_amount' => $request->tutorAmount, 'tutor_pay_date_time' => date('Y-m-d H:i:s'), 'tutor_payment_status' => 'Success');
        $update = ParentPaymentHelper::update($updateArray, array('id' => $id));
        if ($update) {
            return response()->json(['error_msg' => trans('messages.paymentaddedSuccessfully'), 'data' => array()], 200);
        } else {
            return response()->json(['error_msg' => trans('messages.error_msg'), 'data' => array()], 500);
        }
    }

    public function ajaxListUnpaid(Request $request)
    {
        $data['page'] = $request->page;
        $name = $request->name;

        $created_date = $request->created_date;

        $data['query'] = ParentPaymentHelper::getUnPaidListwithPaginate($name, $created_date);

        return view('admin.tutor.tutor_unpaid_payment_list_ajax', $data);
    }

    public function payMultipleTutorsAmount(Request $request)
    {
        foreach ($request->data as $value) {
            $testData = explode(",", $value);
            $id = $testData[0];
            $payAmmount = $testData[1];
            $updateArray = array('tutor_pay_amount' => $payAmmount, 'tutor_pay_date_time' => date('Y-m-d H:i:s'), 'tutor_payment_status' => 'Success');
            $update = ParentPaymentHelper::update($updateArray, array('id' => $id));
        }

        if ($update) {
            return response()->json(['error_msg' => trans('messages.paymentaddedSuccessfully'), 'data' => array()], 200);
        } else {
            return response()->json(['error_msg' => trans('messages.error_msg'), 'data' => array()], 500);
        }
    }
    public function getPaymentHistory()
    {
        return view('admin.tutor.tutor_payment_history_list');
    }
    public function ajaxHistoryList(Request $request)
    {
        $data['page'] = $request->page;
        $name = $request->name;
        $created_date = $request->created_date;
        $tutorName = $request->tutorName;
        $tutionDay = $request->tutionDay;
        $data['query'] = ParentPaymentHelper::getPaidListwithPaginate($name, $created_date, $tutorName, $tutionDay);
        return view('admin.tutor.tutor_payment_history_list_ajax', $data);
    }
    public function filterPaymentHistory(Request $request)
    {
        $name = $request->name;
        $tutorName = $request->tutorname;
        $date = $request->date;
        $tutionDay = $request->tutionDay;
        $filename = 'Tutors Payment History';
        $headers = [
            'Content-type' => 'text/csv',
            'Content-Disposition' =>
            'attachment; filename=' . $filename . '.csv',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];
        $data['historyData'] = ParentPaymentHelper::downloadPaidList($name, $date, $tutorName, $tutionDay);
        $mianarr = [];
        foreach ($data['historyData'] as $keyy) {
            $mianarr[] = $keyy;
        }
        $columns = [
            'No',
            'Tutor Name',
            'Parent Name',
            'Day of Tution',
            'Time of Tution',
            'Rate',
            'Commission',
            'Month',
            'Amount to be Paid',
        ];
        $callback = function () use ($mianarr, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            $ino = 1;

            foreach ($mianarr as $val) {
                $percentage = 100 / $val->pay_amount;
                $tutorAmount = $val->pay_amount - $val->total_commision;
                $tutorName = $val->parentDetail->tutorDetails->first_name ? $val->parentDetail->tutorDetails->first_name :'';
                $parentFirstName = $val->userDetails->first_name ? $val->userDetails->first_name :'';
                $parentLastName =$val->userDetails->first_name ? $val->userDetails->first_name :'';
                $parentName = $parentFirstName.' '.$parentLastName;
                $day = $val->parentDetail->tuition_day ? $val->parentDetail->tuition_day :'';
                $time = $val->parentDetail->tuition_time ? $val->parentDetail->tuition_time :'';
                $rate = $val->pay_amount;
                $commission = number_format($percentage).'%';
                if ($val->created_at != ''){
                    $date = date('m', strtotime($val->created_at));
                }
                fputcsv($file, [
                    $ino,
                    $tutorName,
                    $parentName,
                    $day,
                    $time,
                    $rate,
                    $commission,
                    $date,
                    $tutorAmount
                ]);
                $ino++;
            }
            fclose($file);
        };
        return response()->stream($callback, 200, $headers);
    }
}
