<?php



namespace App\Http\Controllers\Frontend\Tutor;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class TutorProfileController extends Controller

{
    public $successStatus = 200;
    public function index()
    {
        $user = Auth::guard('web')->user();
        return view('frontend.tutor.tutor-profile');
    }
}
