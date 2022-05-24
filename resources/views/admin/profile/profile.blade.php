@extends('layouts.master')
@section('content')
<style>
    .error {
        color: red;
    }
</style>
<link href="{{asset('assets/css/toastr.css')}}" type="text/css">
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Profile Personal Information-->
        <div class="d-flex flex-row">
            <!--begin::Aside-->
            <div class="flex-row-auto offcanvas-mobile col-md-3" id="kt_profile_aside">
                <!--begin::Profile Card-->
                <div class="card card-custom card-stretch">
                    <!--begin::Body-->
                    <div class="card-body pt-4">
                        <!--begin::Toolbar-->

                        <div class="d-flex align-items-center">
                            <div class="symbol symbol-60 symbol-xxl-100 mr-5 align-self-start align-self-xxl-center">
                                <div class="symbol-label"> <img id="auth_image_new" style="width:80px;height:80px;" src="@if(auth()->user()->profile_photo !=''){{auth()->user()->profile_photo}}@else{{asset('uploads/avatar.jpg')}}@endif"></div>
                                <i class="symbol-badge bg-success"></i>
                            </div>

                        </div>
                        <!--end::User-->
                        <!--begin::Contact-->
                        <div class="py-9">
                            <div class="d-flex align-items-center mb-2">
                                <span class="font-weight-bold mr-2">Full Name:</span>
                                <a href="#" class="text-muted text-hover-primary" id="auth_fname">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</a>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="font-weight-bold mr-2">Email:</span>
                                <a href="#" class="text-muted text-hover-primary" id="auth_email" style="word-break: break-all;">{{auth()->user()->email}}</a>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <span class="font-weight-bold mr-2">Mobile Number:</span>
                                <span class="text-muted" id="auth_mobile">{{auth()->user()->mobile_id}}</span>
                            </div>

                        </div>
                        <!--end::Contact-->
                        <!--begin::Nav-->
                        <div class="navi navi-bold navi-hover navi-active navi-link-rounded">

                            <div class="navi-item mb-2">
                                <a href="javascript:void(0)" data-ids="personal" id="personal_id" class="navi-link py-4 active hideshow">
                                    <span class="navi-icon mr-2">
                                        <span class="svg-icon">
                                            <!--begin::Svg Icon | path:assets/media/svg/icons/General/User.svg-->
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                    <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                                    <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero"></path>
                                                </g>
                                            </svg>
                                            <!--end::Svg Icon-->
                                        </span>
                                    </span>
                                    <span class="navi-text font-size-lg">Personal Information</span>
                                </a>
                            </div>

                            <div class="navi-item mb-2">
                                <a href="javascript:void(0)" id="cpersonal_id" data-ids="changepassword" id="ChaClass" class="navi-link py-4 hideshow">
                                    <span class="navi-icon mr-2">
                                        <span class="svg-icon">
                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Shield-user.svg-->
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24"></rect>
                                                    <path d="M4,4 L11.6314229,2.5691082 C11.8750185,2.52343403 12.1249815,2.52343403 12.3685771,2.5691082 L20,4 L20,13.2830094 C20,16.2173861 18.4883464,18.9447835 16,20.5 L12.5299989,22.6687507 C12.2057287,22.8714196 11.7942713,22.8714196 11.4700011,22.6687507 L8,20.5 C5.51165358,18.9447835 4,16.2173861 4,13.2830094 L4,4 Z" fill="#000000" opacity="0.3"></path>
                                                    <path d="M12,11 C10.8954305,11 10,10.1045695 10,9 C10,7.8954305 10.8954305,7 12,7 C13.1045695,7 14,7.8954305 14,9 C14,10.1045695 13.1045695,11 12,11 Z" fill="#000000" opacity="0.3"></path>
                                                    <path d="M7.00036205,16.4995035 C7.21569918,13.5165724 9.36772908,12 11.9907452,12 C14.6506758,12 16.8360465,13.4332455 16.9988413,16.5 C17.0053266,16.6221713 16.9988413,17 16.5815,17 C14.5228466,17 11.463736,17 7.4041679,17 C7.26484009,17 6.98863236,16.6619875 7.00036205,16.4995035 Z" fill="#000000" opacity="0.3"></path>
                                                </g>
                                            </svg>
                                            <!--end::Svg Icon-->
                                        </span>
                                    </span>
                                    <span class="navi-text font-size-lg">Change Password</span>

                                </a>
                            </div>


                        </div>
                        <!--end::Nav-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Profile Card-->
            </div>
            <!--end::Aside-->
            <!--begin::Content-->
            <div class="flex-row-fluid ml-lg-8" id="personam_id">
                <!--begin::Card-->

                <div class="card card-custom card-stretch">
                    <!--begin::Header-->
                    <div class="card-header py-3">
                        <div class="card-title align-items-start flex-column">
                            <h3 class="card-label font-weight-bolder text-dark">Personal Information</h3>
                            <span class="text-muted font-weight-bold font-size-sm mt-1">Update your personal informaiton</span>
                        </div>
                        <div class="card-toolbar">
                            <button type="button" class="btn btn-primary mr-2" id="update_id" style="background-color:#3498db !important">Update</button>

                        </div>
                    </div>
                    <form class="form" id="submitid" enctype="multipart/form-data">
                        <!--end::Header-->
                        <!--begin::Form-->

                        <!--begin::Body-->
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <label class="col-xl-3"></label>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">Profile </label>
                                <div class="col-lg-9 col-xl-6">
                                    <div class="image-input image-input-outline image-input-empty" id="kt_profile_avatar" style="background-image: url(@if(auth()->user()->profile_photo !=''){{auth()->user()->profile_photo}}@else{{asset('uploads/avatar.jpg')}}@endif)">
                                        <div class="image-input-wrapper" style="background-image: none;"></div>
                                        <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change Image">
                                            <i class="fa fa-pen icon-sm text-muted"></i>
                                            <input type="file" name="profile_avatar" accept=".png, .jpg, .jpeg">
                                        </label>
                                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="" data-original-title="Cancel Image">
                                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                                        </span>
                                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="" data-original-title="Remove Image">
                                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                                        </span>
                                    </div>
                                    <span class="form-text error image_error"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">First Name <span class="text-danger">*</span></label>
                                <div class="col-lg-9 col-xl-6">
                                    <input class="form-control form-control-lg form-control-solid validate_field" autocomplete="off" id="full_name" type="text" value="{{Auth::user()->first_name}}" data-msg="First name" name="full_name">
                                    <span class="form-text error  full_name_error"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">Last Name <span class="text-danger">*</span></label>
                                <div class="col-lg-9 col-xl-6">
                                    <input class="form-control form-control-lg form-control-solid validate_field" autocomplete="off" id="last_name" type="text" value="{{Auth::user()->last_name}}" data-msg="Last name" name="last_name">
                                    <span class="form-text error  last_name_error"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">Email <span class="text-danger">*</span></label>
                                <div class="col-lg-9 col-xl-6">
                                    <input class="form-control form-control-lg form-control-solid email-validate validate_field  email_id" type="text" autocomplete="off" id="email_id" value="{{auth()->user()->email}}" name="email_id" data-msg="Email">
                                    <span class="form-text error  email_id_error"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">Mobile Number<span class="text-danger">*</span></label>
                                <div class="col-lg-9 col-xl-6">
                                    <input class="form-control form-control-lg form-control-solid validate_field phone-number-validate mobile_id" type="text" autocomplete="off" id="mobile_id" value="{{auth()->user()->mobile_id}}" name="mobile_id" data-msg="Mobile Number">
                                    <span class="form-text error mobile_id_error"></span>
                                </div>
                            </div>




                        </div>
                        <!--end::Body-->
                    </form>
                    <!--end::Form-->
                </div>

            </div>
            <div class="flex-row-fluid ml-lg-8" id="cpassword_id" style="display:none">
                <!--begin::Card-->
                <form class="form" id="change_password_id" enctype="multipart/form-data">
                    <div class="card card-custom">
                        <!--begin::Header-->
                        <div class="card-header py-3">
                            <div class="card-title align-items-start flex-column">
                                <h3 class="card-label font-weight-bolder text-dark">Change Password</h3>
                                <span class="text-muted font-weight-bold font-size-sm mt-1">Change your account password</span>
                            </div>
                            <div class="card-toolbar">
                                <button type="button" id="update_password" class="btn btn-primary mr-2" style="background-color:#3498db !important">Change Password</button>

                            </div>
                        </div>
                        <!--end::Header-->
                        <!--begin::Form-->

                        <div class="card-body">
                            <!--begin::Alert-->

                            <!--end::Alert-->
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label text-alert">Current Password <span class="text-danger">*</span></label>
                                <div class="col-lg-9 col-xl-6">
                                    <input type="password" name="current_password" id="current_password" class="form-control form-control-lg form-control-solid mb-2 validate_field_password" data-msg="Current Password" placeholder="Current Password">
                                    <span class="form-text error current_password_error"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label text-alert">New Password <span class="text-danger">*</span></label>
                                <div class="col-lg-9 col-xl-6">
                                    <input type="password" name="new_password" id="new_password" class="form-control form-control-lg form-control-solid validate_field_password" data-msg="New Password" placeholder="New Password">
                                    <span class="form-text error new_password_error"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label text-alert">Confirm Password <span class="text-danger">*</span></label>
                                <div class="col-lg-9 col-xl-6">
                                    <input type="password" name="confirmation_password" id="confirmation_password" data-msg="Confirm Password" class="form-control form-control-lg form-control-solid validate_field_password" placeholder="Confirm Password">
                                    <span class="form-text error confirmation_password_error"></span>
                                </div>
                            </div>
                        </div>

                        <!--end::Form-->
                    </div>
                </form>
            </div>
            <!--end::Content-->
        </div>
        <!--end::Profile Personal Information-->
    </div>
    <!--end::Container-->
</div>

@endsection
@section('page-js')
<script src="{{asset('assets/js/toastr.min.js')}}"></script>
<script src="{{asset('assets/js/pages/custom/profile/profile.js')}}"></script>
<script src="{{asset('assets/Modulejs/profile.js')}}?time={{ time() }}"></script>
<script>
    var CSRF_TOKEN = '{{csrf_token()}}';
    var _PROFILE_UPDATE = "{{route('profile-update')}}";
    var _CHECK_CURRENT_PASSWORD = "{{route('check-current-password')}}";
    var _PASSWORD_UPDATE = "{{route('change-password-update')}}";
    $(".mobile_id").inputmask("mask", {
        "mask": "(999) 999-9999"
    });
</script>
@endsection