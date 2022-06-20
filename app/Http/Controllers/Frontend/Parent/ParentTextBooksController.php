<?php

namespace App\Http\Controllers\Frontend\Parent;

use App\Helpers\TextBooksHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ParentTextBooksController extends Controller
{
    public function index(Request $request)
    {
        $auth = auth()->user();
        $userId = $auth['id'];
        if($request->input('page')){
            $data['page'] = $request->input('page');
        }
        else{
            $data['page'] = 1;
        }
        $data['query'] = TextBooksHelper::getListwithPaginateParentTextBook($userId);
        // dd($data['query']);
        return view('frontend.parent.parent_text_books', $data);
    }
}
