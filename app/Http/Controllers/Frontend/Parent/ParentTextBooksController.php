<?php

namespace App\Http\Controllers\Frontend\Parent;

use App\Helpers\ParentDetailHelper;
use App\Helpers\TextBooksHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;


class ParentTextBooksController extends Controller
{
    public function index(Request $reques)
    {
        return view('frontend.parent.parent_text_books');
    }


    public function paginate($items, $perPage = 10, $page = null)
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $total = count($items);
        $currentpage = $page;
        $offset = ($currentpage * $perPage) - $perPage;
        $itemstoshow = array_slice($items, $offset, $perPage);
        return new LengthAwarePaginator($itemstoshow, $total, $perPage);
    }


    public function ajaxList(Request $request)
    {

        $data['page'] = $request->page;
        $auth = auth()->user();
        $userId = $auth['id'];
        if ($request->input('page')) {
            $this->data['page'] = $request->input('page');
        } else {
            $this->data['page'] = 1;
        }
        $getParentInquiry = ParentDetailHelper::getAllInquiry($userId);
        $getParentSubjectInquiry = ParentDetailHelper::getSubjectInquiry($userId);
        $textBookdata =  TextBooksHelper::getListwithPaginateParentTextBook($getParentInquiry);
        $mainArray = array();
        if (count($textBookdata) > 0) {
            foreach ($textBookdata as $tkey) {
                if ($tkey->type == "tutor") {
                    if (in_array($tkey->user_id, $getParentInquiry)) {
                        if (in_array($tkey->subject_id, $getParentSubjectInquiry)) {
                            $mainArray[] = $tkey;
                        }
                    }
                } else if ($tkey->type == "admin") {
                    if (in_array($tkey->subject_id, $getParentSubjectInquiry)) {
                        $mainArray[] = $tkey;
                    }
                }
            }
        }
        $this->data['query'] = $mainArray;
        $paginatinData = $this->paginate($mainArray);
        $this->data['data'] = $paginatinData->withPath('parent-text-books');
   
        return view('frontend.parent.parent_text_books_ajax', $this->data);
    }
}
