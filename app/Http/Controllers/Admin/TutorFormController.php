<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\TutorFormHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class TutorFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('admin.tutor-form.index');
    }
      public function ajaxList(Request $request)
      {
        $data['page'] = $request->page;
        $data['query'] = TutorFormHelper::getListwithPaginate($request);
        return view('admin.tutor-form.tutor_form_ajax', $data);
      }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tutor-form.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tutor-name' => 'required',
            'tuition_day' => 'required',
            'rate' => 'required |max:5',
            'month' => 'required',
            'student_name' => 'required',
            'tuition_time' => 'required',
            'commission' => 'required|max:2'
        ]);
        if ($validator->fails()) {
            return redirect()->route('tutor-form.create')
            ->withErrors($validator, 'useredit')
            ->withInput();
        } else {
         
            $tutorFormArray= array(
                'tutor_name' => $request->input('tutor-name'),
                'student_name' => $request->student_name,
                'day_of_tution' => $request->tuition_day,
                'tution_time' => $request->tuition_time,
                'rate' => $request->rate,
                'commission' => $request->commission,
                'month' => $request->month,
            );
            $update = TutorFormHelper::save($tutorFormArray);
            if ($update) {
                Session::flash('success', trans('messages.addedSuccessfully'));
                return redirect()->route('tutor-form.index');
            } else {
                Session::flash('error', trans('messages.error'));
                return redirect()->route('tutor-form.create');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
