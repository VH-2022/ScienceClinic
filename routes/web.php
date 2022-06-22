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

Route::get('stripe-payment/{id}','App\Http\Controllers\PaymentController@stripePayment')->name('stripe-payment');
Route::post('redirectPayment','App\Http\Controllers\PaymentController@redirectPayment')->name('redirectPayment');
Route::get('paypal-payment/{id}','App\Http\Controllers\PaymentController@paypalPayment')->name('paypal-payment');
Route::post('/ipn','App\Http\Controllers\PaymentController@ipn')->name('ipn');
Route::post('/payment_script_status', 'App\Http\Controllers\PaymentController@payment_script_status')->name('payment_script_status');

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
        $backendVerified->get('get-count', "TutorMasterController@getCount")->name('get-count');
        
        $backendVerified->get('tutor-other-list', "TutorMasterController@getOtherDetails")->name('tutor-other-list');
        $backendVerified->get('changestatus', "TutorMasterController@changeStatus")->name('changestatus');
        $backendVerified->post('add-hourly-rate', "TutorMasterController@addHourlyRate")->name('add-hourly-rate');

        $backendVerified->get('subject-inquiry', "SearchInquiryController@index")->name('subject.inquiry');
        $backendVerified->get('subject-inquiry-ajax', "SearchInquiryController@ajaxList")->name('subject-inquiry-ajax');

        $backendVerified->resource('blog-master', "BlogMasterController");
        $backendVerified->get('blog-master-ajax', "BlogMasterController@ajaxList")->name('blog-master-ajax');
        $backendVerified->get('change-status', "TutorMasterController@changeStatus")->name('change-status');
        $backendVerified->get('contact-ajax', "ContactListController@ajaxList")->name('contact-ajax');
        $backendVerified->resource('contact-list', "ContactListController");
        $backendVerified->resource('support-ticket', "SupportTicketController");
        $backendVerified->get('support-ajax', "SupportTicketController@ajaxList")->name('support-ajax');
        $backendVerified->get('about-ajax', "AboutController@ajaxList")->name('about-ajax');
        $backendVerified->resource('about-list', "AboutController");
        $backendVerified->get('parent-list', "ParentMasterController@index")->name('parent.index');
        $backendVerified->get('parent-list-ajax', "ParentMasterController@ajaxList")->name('parent-list-ajax');
        $backendVerified->get('parent-list/{id}', "ParentMasterController@parentDetails")->name('parent.details');
        $backendVerified->get('tutor-Inquiry', "ParentMasterController@getInquiryDetails")->name('tutor.inquiry');
        $backendVerified->get('calander-booking', "ParentMasterController@getCalanderBooking")->name('calander-booking');
        $backendVerified->get('getBooklesson', "ParentMasterController@getBooklesson")->name('getBooklesson');
        $backendVerified->post('update-book-lesson', "ParentMasterController@updateBooklesson")->name('update-book-lesson');
        $backendVerified->get('parent-book-lesson-data', "ParentMasterController@getParentBookLesson")->name('parent-book-lesson-data');
        $backendVerified->delete('parent-delete/{id}', "ParentMasterController@destroy");
        $backendVerified->get('testimonial-ajax', "TestimonialController@ajaxList")->name('testimonial-ajax');
        $backendVerified->resource('testimonial', "TestimonialController");

        $backendVerified->get('send-payment-link-parent', "ParentMasterController@sendPaymentLinkMail")->name('send-payment-link-parent');
        $backendVerified->resource('parent-payment-history', "ParentPaymentController");
        $backendVerified->get('parent-payment-list-ajax', "ParentPaymentController@ajaxList")->name('parent-payment-list-ajax');
        
        $backendVerified->resource('tutor-payment-history', "TutorPaymentController");
        $backendVerified->resource('site-setting', "SiteSettingController");
        $backendVerified->resource('online-tutoring', "OnlineTutoringController");
        $backendVerified->resource('text-books', "TextBooksController");
        $backendVerified->resource('e-learning-cms', "ELearningController");
        $backendVerified->get('online-tutoring-ajax-list', "OnlineTutoringController@ajaxList")->name('online-tutoring-ajax-list');
        $backendVerified->get('text-books-ajax-list', "TextBooksController@ajaxList")->name('text-books-ajax-list');
        $backendVerified->get('e-learning-cms-ajax-list', "ELearningController@ajaxList")->name('e-learning-cms-ajax-list');
        

        


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
    $frontend->get('tutors-details/{id}', "FindATutorController@tutorDetails")->name('tutors-details');;
    $frontend->get('tutor-availability-get', "FindATutorController@tutorAvailabilityDetails")->name('tutor-availability-get');
    $frontend->get('submit-review', "FindATutorController@saveReview")->name('submit.review');
    $frontend->post('check-email-parent', "FindATutorController@checkEmailParent")->name('check-email-parent');
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
    $frontend->get('E-Learning', 'HomeController@getELearningdata')->name('E-Learning');
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
        $backendVerified->get('tutor-availability', 'TutorAvailabilityController@index')->name('tutor-availability');
        $backendVerified->post('add-availability', 'TutorAvailabilityController@addTutorAvailability')->name('add-availability');
        $backendVerified->get('get-tutor-availability', 'TutorAvailabilityController@getTutorAvailabilityDetails')->name('get-tutor-availability');
        $backendVerified->get('tutor-profile', 'TutorProfileController@index')->name('tutor-profile');
        $backendVerified->get('tutor-subject', 'TutorSubjectController@index')->name('tutor-subject');
        $backendVerified->post('tutor-subject-store', 'TutorSubjectController@store')->name('tutor-subject-store');
        $backendVerified->get('tutor-subject-ajax', "TutorSubjectController@ajaxList")->name('tutor-subject-ajax');
        $backendVerified->get('tutor-subject-edit/{id}', "TutorSubjectController@edit")->name('tutor-subject-edit');
        $backendVerified->post('check-level-subject', "TutorSubjectController@checkData")->name('check-level-subject');
        $backendVerified->put('tutor-subject-update', "TutorSubjectController@update")->name('tutor-subject-update');
        $backendVerified->delete('remove-subject/{id}', "TutorSubjectController@delete")->name('remove-subject');
        $backendVerified->get('tutor-online-subject-ajax', "TutorSubjectController@onlineAjaxList")->name('tutor-online-subject-ajax');
        $backendVerified->get('tutor-online-subject-edit/{id}', "TutorSubjectController@editOnlineSubject")->name('tutor-online-subject-edit');
        $backendVerified->get('tutor-profile-photo', 'TutorProfilePhotoController@index')->name('tutor-profile-photo');
        $backendVerified->post('update-tutor-image', 'TutorProfilePhotoController@updateTutorImage')->name('update-tutor-image');
        $backendVerified->get('get-bookslot-data', 'TutorAvailabilityController@getBookedSlotData')->name('get-bookslot-data');
        $backendVerified->get('show-bookslot-data/{id}/{time}', 'TutorAvailabilityController@showBookedslots')->name('show-bookslot-data');
        $backendVerified->get('edit-book-slot', 'TutorAvailabilityController@editBookSlot')->name('edit-book-slot');
        $backendVerified->post('update-book-slot', 'TutorAvailabilityController@updateBookSlot')->name('update-book-slot');
        $backendVerified->post('cancel-slot', 'TutorAvailabilityController@cancelSlot')->name('cancel-slot');
        $backendVerified->post('store-account-details', 'TutorAccountController@storeAccountDetails')->name('store-account-details');
        $backendVerified->get('get-tutor-bank-details', 'TutorAccountController@getTutorBankDetails')->name('get-tutor-bank-details');
        $backendVerified->resource('tutor-resource', "TutorResourceController");
        $backendVerified->get('tutor-resource-ajax', "TutorResourceController@resourceAjaxList")->name('tutor-resource-ajax');
        $backendVerified->resource('tutor-text-books', "TutorTextBooksController");
        $backendVerified->get('tutor-text-books-ajax-list', "TutorTextBooksController@ajaxList")->name('tutor-text-books-ajax-list');
        $backendVerified->get('tutor-parent-list', 'ParentListController@index')->name('tutor-parent-list');
        $backendVerified->get('tutor-parent-list/{id}', 'ParentListController@getParentDetails')->name('tutor-parent-details');
        $backendVerified->get('parent-subject-details', 'ParentListController@parentSubjectDetails')->name('parent-subject-details');
        $backendVerified->post('add-teaching-hours', 'ParentListController@saveTutoringHours')->name('add-teaching-hours');
        $backendVerified->resource('tutor-resource', "TutorResourceController");
        $backendVerified->get('tutor-resource-ajax', "TutorResourceController@resourceAjaxList")->name('tutor-resource-ajax');
        $backendVerified->get('tutor-feedback', "TutorFeedBackController@index")->name('tutor-feedback');

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
        $parentVerified->get('bookings', 'BookingsController@index')->name('booking.index');
        $parentVerified->post('add-tutor-availability', 'BookingsController@addTutorAvailability')->name('add-tutor-availability');
        $parentVerified->get('add-tutor-availability-data', 'BookingsController@getTutorAvailabilityDetails')->name('add-tutor-availability-data');
        $parentVerified->get('parent-text-books', 'ParentTextBooksController@index')->name('parent-text-books');
        $parentVerified->get('feedback', 'FeedbackController@index')->name('feedback');
        $parentVerified->get('feedback/{uid}', 'FeedbackController@feedbackForm')->name('feedback-form');
        $parentVerified->post('submit-parent-review', 'FeedbackController@submitParentFeedback')->name('submit-parent-review');
        $parentVerified->get('get-feedback', 'FeedbackController@getFeedback')->name('get-feedback');
        $parentVerified->get('parent-text-books-ajax', 'ParentTextBooksController@ajaxList')->name('parent-text-books-ajax');
    });
  
});