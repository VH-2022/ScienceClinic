<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/





Route::get('/clear-compiled', function () {
    Artisan::call('clear-compiled');
});
Route::get('/clear1', function () {

    Artisan::call('config:clear');
});
Route::get('/clear2', function () {
    Artisan::call('cache:clear');
});
Route::get('/clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    echo '<script>alert("All Cache & Clear Success")</script>';
});
Route::get('/clear-optimize', function () {
    Artisan::call('optimize:clear');
    echo '<script>alert("Clear Success")</script>';
});

Route::group(['namespace' => 'App\Http\Controllers\Admin'], function ($admins) {
    Route::post('verify-login', 'LoginController@verifyLogin')->name('verify-login');
    Route::get('check-email-admin', "LoginController@checkEmail")->name('check-email-admin');
    Route::post('forgot-password-admin-verify', "ForgotPasswordController@forgotPasswordAdminVerify")->name('forgot-password-admin-verify');
    Route::get('admin-reset-password/{id}', 'ResetPasswordController@ResetPassword')->name('admin-reset-password');
    Route::post('update-admin-password/{id}', 'ResetPasswordController@UpdatePasswordAdmin')->name('update-admin-password');
    $admins->middleware(['auth:super_admin', 'verified'])->group(function ($backendVerified) {
        $backendVerified->get('logout-super-admin', 'LoginController@logout')->name('super-admin-logout');
        $backendVerified->get('admin','DashboardController@index')->name('admin-dashboard');
        $backendVerified->get('profile', "ProfileController@profile")->name('profile');
        $backendVerified->post('profile-update', "ProfileController@updateProfile")->name('profile-update');
        $backendVerified->post('check-current-password', "ProfileController@checkCurrentPassword")->name('check-current-password');
        $backendVerified->post('change-password-update', "ProfileController@PasswordUpdate")->name('change-password-update');
        $backendVerified->resource('subject-master', "SubjectController");
        $backendVerified->get('subject-master-ajax-list', "SubjectController@ajaxList");
        $backendVerified->resource('sub-subject-master', "SubSubjectController");
        $backendVerified->get('sub-subject-master-ajax-list', "SubSubjectController@ajaxList");
        $backendVerified->resource('tutor-level', "TutorLevelController");
        $backendVerified->get('tutor-level-ajax', "TutorLevelController@ajaxList")->name('tutor-level-ajax');
        $backendVerified->get('tutor-master-ajax', "TutorMasterController@ajaxList")->name('tutor-master-ajax');
        $backendVerified->resource('tutor-master', "TutorMasterController");
        $backendVerified->get('tutor-university', "TutorMasterController@getUniversityDetails")->name('tutor-university');
        $backendVerified->get('tutor-subject', "TutorMasterController@getSubjectDetails")->name('tutor-subject');
        $backendVerified->get('tutor-level-ist', "TutorMasterController@getLevelDetails")->name('tutor-level-list');
        $backendVerified->get('tutor-other-list', "TutorMasterController@getOtherDetails")->name('tutor-other-list');
        $backendVerified->get('changestatus', "TutorMasterController@changeStatus")->name('changestatus');
        $backendVerified->get('subject-inquiry', "SearchInquiryController@index")->name('subject.inquiry');
        $backendVerified->get('subject-inquiry-ajax', "SearchInquiryController@ajaxList")->name('subject-inquiry-ajax');

        $backendVerified->resource('blog-master', "BlogMasterController");
        $backendVerified->get('blog-master-ajax', "BlogMasterController@ajaxList")->name('blog-master-ajax');
        $backendVerified->get('change-status', "TutorMasterController@changeStatus")->name('change-status');
        $backendVerified->get('contact-ajax', "ContactListController@ajaxList")->name('contact-ajax');
        $backendVerified->resource('contact-list', "ContactListController");
        $backendVerified->get('about-ajax', "AboutController@ajaxList")->name('about-ajax');
        $backendVerified->resource('about-list', "AboutController");
        $backendVerified->get('parent-list', "ParentMasterController@index")->name('parent.index');
        $backendVerified->get('parent-list-ajax', "ParentMasterController@ajaxList")->name('parent-list-ajax');
        $backendVerified->get('parent-list/{id}', "ParentMasterController@parentDetails")->name('parent.details');
        $backendVerified->get('tutor-Inquiry', "ParentMasterController@getInquiryDetails")->name('tutor.inquiry');
        $backendVerified->delete('parent-delete/{id}', "ParentMasterController@destroy");
        $backendVerified->get('testimonial-ajax', "TestimonialController@ajaxList")->name('testimonial-ajax');
        $backendVerified->resource('testimonial', "TestimonialController");
    });
});

Route::group(['namespace' => 'App\Http\Controllers\Frontend'], function ($frontend) {
  
    $frontend->get('/', 'HomeController@index');
    $frontend->get('/subject/{id}', 'UserSubjectController@index');
    $frontend->get('/sub-subject/{id}', 'UserSubjectController@subSubjectDetails');
    $frontend->resource('become-tutor', "BecomeTutorController");
    $frontend->get('check-email', "BecomeTutorController@checkEmail")->name('check.email');
    $frontend->get('find-tutor', "FindATutorController@index")->name('find-tutor');
    $frontend->get('find-tutor-user', "FindATutorController@getTutors")->name('get.tutors');
    $frontend->get('tutors-details/{id}', "FindATutorController@tutorDetails")->name('tutors-details');
    $frontend->get('submit-review', "FindATutorController@saveReview")->name('submit.review');
    $frontend->post('submit-inquiry', "FindATutorController@saveInquiry")->name('submit.inquiry');
    $frontend->get('blog', "BlogController@index")->name('blog');
    $frontend->get('blog-detail/{id}', "BlogController@blogDetails")->name('blog-detail');

    $frontend->resource('contact', "ContactController");
    $frontend->get('about', "AboutsController@index")->name('about');
    $frontend->get('forgot-password-user', 'ForgotPasswordController@index')->name('forgot-password-user');
    $frontend->post('forgot-password-verify', 'ForgotPasswordController@ForgotPasswordVerify')->name('forgot-password-verify');
    $frontend->get('user-reset-password/{id}', 'ResetPasswordController@ResetPassword')->name('user-reset-password');
    $frontend->post('update-user-password/{id}', 'ResetPasswordController@UpdatePassword')->name('update-user-password');
    $frontend->get('tutors', 'TutorListController@index')->name('tutors');
    // $frontend->get('contact/create', "ContactController@create")->name('contact.create');
    // $frontend->post('contact/store', "ContactController@store")->name('contact.store');
});

Route::group(['namespace' => 'App\Http\Controllers\Frontend\Tutor'], function ($tfrontend) {
    $tfrontend->get('tutor-login', 'TutorLoginController@index')->name('tutor-login');
    $tfrontend->post('verify-login-tutor', 'TutorLoginController@verifyLogin')->name('verify-login-tutor');
    $tfrontend->middleware(['auth:web', 'verified'])->group(function ($backendVerified) {
        $backendVerified->get('tutor-dashboard','TutorDashboardController@index')->name('tutor-dashboard');
        $backendVerified->get('tutor-logout', 'TutorLoginController@logout')->name('tutor-logout');
        $backendVerified->get('tutor-verify','TutorVerifyController@index')->name('tutor-verify');
        $backendVerified->post('tutor-profile', 'TutorVerifyController@updateProfile')->name('tutor-profile');
        $backendVerified->post('tutor-dbs', 'TutorVerifyController@updateDBS')->name('tutor-dbs');
        $backendVerified->post('tutor-certificate', 'TutorVerifyController@updateCertificate')->name('tutor-certificate');
        $backendVerified->get('tutor-account', 'TutorAccountController@index')->name('tutor-account');
        $backendVerified->get('check-email-tutor', "TutorAccountController@checkEmail")->name('check-email-tutor');
        $backendVerified->put('update-tutor', "TutorAccountController@updateProfile")->name('update-tutor');
        $backendVerified->get('check-password-tutor', "TutorAccountController@checkCurrentPassword")->name('check-password-tutor');
        $backendVerified->post('update-password-tutor', "TutorAccountController@updatePassword")->name('update-password-tutor');
    });
});
Route::group(['namespace' => 'App\Http\Controllers\Frontend\Parent'], function ($pfrontend) {
    $pfrontend->get('parent-login', 'ParentLoginController@index')->name('parent-login');
    $pfrontend->post('verify-login-parent', 'ParentLoginController@verifyLogin')->name('verify-login-parent');
    $pfrontend->middleware(['auth:parent', 'verified'])->group(function ($parentVerified) {
       
        $parentVerified->get('parent-dashboard', 'ParentDashboardController@index')->name('parent-dashboard');
        $parentVerified->get('parent-account', 'ParentAccountController@index')->name('parent-account');
        $parentVerified->get('check-email-parent', 'ParentAccountController@checkEmail')->name('check-email-parent');
        $parentVerified->get('check-email-parent', 'ParentAccountController@checkEmail')->name('check-email-parent');
        $parentVerified->post('update-parent', 'ParentAccountController@parentUpdate')->name('update-parent');
        $parentVerified->get('check-old-password', 'ParentAccountController@checkOldPassword')->name('check-old-password');
        $parentVerified->post('update-password', 'ParentAccountController@updatePassword')->name('update-password');
       
        $parentVerified->get('parent-logout', 'ParentLoginController@logout')->name('parent-logout');
        
    });
  
});