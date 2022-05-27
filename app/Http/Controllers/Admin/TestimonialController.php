<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\TestimonialHelper;
use Illuminate\Support\Facades\Validator;

class TestimonialController extends Controller
{
    public $successStatus =200;

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index()

    {

      return view('admin.testimonial.testimonial');

    }

    public function ajaxList(Request $request){

        $data['page'] = $request->page; 

        $author_name = $request->author_name;
        $description = $request->description;

        $created_date = $request->created_date;

        $data['query'] = TestimonialHelper::getListwithPaginate($author_name,$description,$created_date);

        return view('admin.testimonial.testimonial_ajax',$data);

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

            'author_name' => 'required',
            'description' => 'required'
         ]);

         if ($validator->fails()) {

             return response()->json(['error_msg' => $validator->errors()->all(), 'data' => array()], 400);

         }

         $data_array = array(

            'author_name' => $request->author_name,
            'description' => $request->description

         );

         $update = TestimonialHelper::save($data_array);

            if($update){        

         

         return response()->json(['error_msg' =>trans('messages.addedSuccessfully'), 'data' => array()], 200);

         }else{

            return response()->json(['error_msg' =>trans('messages.error'), 'data' => array()], 500);

      }

   }

    public function edit($id)

   {

       $auth = auth()->user();

       if(empty($auth)){

           return redirect('/login');

       }

       $query=TestimonialHelper::getDetailsById($id);

       return response()->json(['error_msg' =>trans('messages.updatedSuccessfully'), 'data' => array($query)], 200);

   }

   public function update(Request $request, $id)

   {
    //    return $request->all();
        $validator = Validator::make($request->all(), [

            'author_name' => 'required',
            'description' => 'required'

           ]);

           if ($validator->fails()) {

               return response()->json(['error_msg' => $validator->errors()->all(), 'data' => array()], 400);

           }

           $data_array = array(

            'author_name' => $request->author_name,
            'description' => $request->description

           );

           $update = TestimonialHelper::update($data_array,array('id'=>$request->input('id')));

           return response()->json(['error_msg' =>trans('messages.updatedSuccessfully'), 'data' => array($update)], 200);

      }

    public function destroy($id)

      {

      $update = TestimonialHelper::SoftDelete(array(),array('id'=>$id));

      if ($update) {

          return response()->json([

              'message' => trans('messages.deletedSuccessfully')

          ]);

          }

          else {

          return response()->json([

              'message' =>  trans('messages.notDeleted')

          ]);

      }

    }

}


