<?php

namespace App\Http\Controllers\Frontend\Parent;

use App\Helpers\ParentDetailHelper;
use App\Helpers\TextBooksHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ParentTextBooksController extends Controller
{
    public function index(Request $request)
    {
        $auth = auth()->user();
        $userId = $auth['id'];
        if($request->input('page')){
            $this->data['page'] = $request->input('page');
        }
        else{
            $this->data['page'] = 1;
        }
        $getParentInquiry = ParentDetailHelper::getAllInquiry($userId);
        $getParentSubjectInquiry = ParentDetailHelper::getSubjectInquiry($userId);
        $textBookdata =  TextBooksHelper::getListwithPaginateParentTextBook($getParentInquiry);
        $mainArray = array();
        if(count($textBookdata) > 0){
            foreach($textBookdata as $tkey){
                if($tkey->type=="tutor"){
                    if(in_array($tkey->user_id,$getParentInquiry)){
                        if(in_array($tkey->subject_id,$getParentSubjectInquiry)){
                            $mainArray[] = $tkey;
                        }
                    }
                }else if($tkey->type=="admin"){
                    if(in_array($tkey->subject_id,$getParentSubjectInquiry)){
                        $mainArray[] = $tkey;
                    }
                }
            }
        }
        $this->data['query'] = $mainArray;
        $this->data['data'] = $this->paginate($mainArray);
        
        return view('frontend.parent.parent_text_books', $this->data);
    }
    public function paginate($items, $perPage = 2, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
