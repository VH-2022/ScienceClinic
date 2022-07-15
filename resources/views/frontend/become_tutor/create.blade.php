@extends('layouts.frontend')

@section('content')
<style>
    .add-subject {
        position: absolute;

        right: 0px;

    }

    .form-data .col-md-6,
    .form-data .col-md-12 {
        margin-bottom: 23px;
    }

    .inputbar-padding {
        padding-top: 10px !important;
    }
</style>
<link href="{{ asset('assets/css/toastr.css') }}" rel="stylesheet" />
<div class="as-mainwrapper">

    <!--Bg White Start-->

    <div class="bg-white">

        <div id="header"></div>

        <!--End of Header Area-->



        <!--background Area Start-->

        <div class="backgrount-area bg-chemistry  full-grayoverlay" style="height: 440px;">

            <div class="banner-content padding-headsection">

                <div class="container">

                    <div class="row">

                        <div class="col-md-12">

                            <div class="text-content-wrapper text-center full-width">

                                <div class="text-content text-center-content">

                                    <h1 class="title1 text-center max-englishtext mb-20">

                                        <span class="tlt block" data-in-effect="fadeInRight" data-out-effect="fadeOutRight">Become a Tutor</span>

                                    </h1>

                                    <p>We are interested in hearing from experienced private tutors who can educate,

                                        guide and inspire students of all ages and levels.</p>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!--End of background Area-->

        <div class="become-text  pt-5px">

            <div class="container">

                <div class="col-md-12 p-0">

                    <div class="mt-20">


                        <p class="become-para">If you have what it takes to motivate, impart knowledge and enabling

                            students of all ages to reach their full potential, please get in touch by completing

                            the form below?</p>

                        <p class="mb-0 become-para">If you submit all the necessary information and documentations,

                            you could be receiving your first student within 24 hours.</p>

                    </div>

                </div>

                <div class="area-sciences">

                    <div>

                        <div class="single-item-text">

                            <h4 class="mb-3">

                                <div class="single-item-text">


                                    <h4 class="mb-3">Apply To Tutor With Science Clinic Private Tutors

                                    </h4>

                                </div>

                            </h4>

                            <div class="contact-form-area">

                                <form action="{{ route('become-tutor.store') }}" method="POST" enctype="multipart/form-data" id="formdata">

                                    @csrf

                                    <div class="row form-data">

                                        <div class="col-md-6">

                                            <input type="text" name="name" maxlength="30" class="mb-0" autocomplete="off" id="name" placeholder="Name">

                                            <span class="text-danger" id="error_name">{{ $errors->useredit->first('name') }}</span>

                                        </div>

                                        <div class="col-md-6">

                                            <input type="text" name="email" class="mb-0" autocomplete="off" id="email" placeholder="Email">

                                            <span class="text-danger" id="error_email">{{ $errors->useredit->first('email') }}</span>

                                        </div>

                                        <div class="col-md-6">

                                            <input type="text" class="mb-0 numberCls" maxlength="12" autocomplete="off" name="mobile" id="mobile" placeholder="Telephone">

                                            <span class="text-danger" id="error_mobile">{{ $errors->useredit->first('mobile') }}</span>

                                        </div>

                                        <div class="col-md-6">

                                            <input type="text" maxlength="255" name="address1" class="mb-0" autocomplete="off" id="address1" placeholder="Address 1">

                                            <span class="text-danger" id="error_address1">{{ $errors->useredit->first('address1') }}</span>

                                        </div>

                                        <div class="col-md-6">

                                            <input type="text" maxlength="255" name="address2" class="mb-0" autocomplete="off" id="address2" placeholder="Address 2">

                                            <span class="text-danger" id="error_address2">{{ $errors->useredit->first('address2') }}</span>

                                        </div>

                                        <div class="col-md-6">

                                            <input type="text" maxlength="255" name="address3" class="mb-0" autocomplete="off" id="address3" placeholder="Address 3">

                                            <span class="text-danger" id="error_address3">{{ $errors->useredit->first('address3') }}</span>

                                        </div>

                                        <div class="col-md-6">

                                            <input type="text" maxlength="15" name="city" class="mb-0" autocomplete="off" id="city" placeholder="Town/City">

                                            <span class="text-danger" id="error_city">{{ $errors->useredit->first('city') }}</span>

                                        </div>

                                        <div class="col-md-6">

                                            <input type="text" name="postcode" maxlength="6" class="mb-0" autocomplete="off" id="postcode" placeholder="Postcode">

                                            <span class="text-danger" id="error_postcode">{{ $errors->useredit->first('postcode') }}</span>

                                        </div>

                                        <div class="col-md-12">

                                            <textarea name="bio" id="bio" class="mb-0" cols="30" rows="10" placeholder="Bio

                                                "></textarea>

                                            <span class="text-danger" id="error_bio">{{ $errors->useredit->first('bio') }}</span>



                                        </div>



                                        <div class="col-md-12">

                                            <div class="row">

                                                <div class="col-md-3 mb-2">

                                                    <h6>University/Institution</h6>

                                                </div>

                                                <div class="col-md-3 mb-2">

                                                    <h6>Qualification</h6>

                                                </div>

                                                <div class="col-md-4 mb-2">

                                                    <h6>Upload Certificates Here</h6>

                                                </div>

                                            </div>

                                            <div class="customer_records position-relative">

                                                <div id="main_id">

                                                    @php

                                                    $uniqid = uniqid();

                                                    @endphp

                                                    <div class="copy_id" id="{{ $uniqid }}">

                                                        <div class="row">

                                                            <div class="col-md-3">

                                                                <input name="university[]" maxlength="35" class="mb-0" autocomplete="off" data-id="{{ $uniqid }}" type="text" placeholder="University/Institution">

                                                                <span id="customer_name_{{ $uniqid }}_error" class="text-danger">{{ $errors->useredit->first('university') }}</span>

                                                            </div>

                                                            <div class="col-md-3">

                                                                <input name="qualification[]" maxlength="35" class="mb-0" autocomplete="off" data-id="{{ $uniqid }}" type="text" placeholder="Qualification">

                                                                <span id="qualification{{ $uniqid }}_error" class="text-danger">{{ $errors->useredit->first('qualification') }}</span>

                                                            </div>

                                                            <div class="col-md-5">

                                                                <div class="downloaded-file position-relative">

                                                                    <div class="chemistry-icon-text">
                                                                        <div class="input-file-bio">
                                                                            <p type="text" class="mb-0 mt-0" id="uploadeviFile" class="input-upload-bio"> </p>
                                                                        </div>

                                                                        <input type="file" class="mb-0 inputbar-padding" name="document_certi[]" data-id="{{ $uniqid }}" class="bio-input-fild" id="uploadeviBtn">

                                                                        <span id="document_certi{{ $uniqid }}_error" class="text-danger"></span>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                            <div class="col-md-1 add"> <a class="extra-fields-customer search-menu" href="javascript:void(0)"><i class="fa fa-plus fa-icon" aria-hidden="true" style="margin-top: 4px;"></i></a></div>

                                                        </div>

                                                    </div>

                                                </div>









                                            </div>



                                            <div class="customer_records_dynamic"></div>



                                        </div>
                                        <div class="col-md-12">

                                            <div class="row">

                                                <div class="col-md-6 mb-2">

                                                    <h6 class="mb-2">Subject you wish to tutor. (required)</h6>

                                                </div>

                                                <div class="col-md-5 mb-2">

                                                    <h6 class="mb-2">Level you wish to tutor. (required)</h6>

                                                </div>

                                                <div class="col-md-1 mb-2">



                                                </div>

                                            </div>

                                            <div class="customer_records position-relative">
                                                <div id="subjects_id">
                                                    @php

                                                    $uniqid = uniqid();

                                                    @endphp
                                                    <input type="hidden" name="main_subject_id[]" value="{{$uniqid}}">
                                                    <div class="copy_subject_id" id="{{$uniqid}}">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="subject-custom">
                                                                    <select id="sub{{$uniqid}}" class="selectpicker " data-id="{{$uniqid }}" name="subject{{$uniqid}}[]" aria-label="Default select example" data-live-search="true">

                                                                        <option value="">Select Subject</option>

                                                                        @foreach ($subject_list as $val)
                                                                        <option value="{{ $val->id }}">{{ $val->main_title }}
                                                                        </option>
                                                                        @endforeach
                                                                    </select>

                                                                    <span class="text-danger" id="subject_{{$uniqid}}_error">{{ $errors->useredit->first('subject') }}</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-5">
                                                                <div class="subject-custom">
                                                                    <select class="selectpicker" data-id="{{$uniqid }}" name="level{{$uniqid}}[]" multiple aria-label="Default select example" data-live-search="true">



                                                                        @foreach ($tutor_level_list as $val)
                                                                        <option value="{{ $val->id }}">{{ $val->title }}
                                                                        </option>
                                                                        @endforeach



                                                                    </select>

                                                                    <span class="text-danger" id="level_{{$uniqid }}_error">{{ $errors->useredit->first('level') }}</span>
                                                                </div>

                                                            </div>
                                                            <div class="col-md-1 add" style="padding-left:15px;">
                                                                <a class="extra-fields-customer1 search-menu" onclick="addmoreSubject()" href="javascript:void(0)"><i class="fa fa-plus fa-icon" aria-hidden="true" style="margin-top: 4px;"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div><br>


                                        <div class="col-md-12 row">
                                            <div class="col-md-6 mb-23">

                                                <h6 class="mb-2">Do you have an enhanced DBS disclosure (less than
                                                    a

                                                    year old)? (required)</h6>

                                                <div class="custom-control custom-radio">

                                                    <input type="radio" id="customRadio2" value="Yes" name="dbsdisclosure" class="custom-control-input" onclick="show1();">

                                                    <label class="custom-control-label" for="customRadio2">Yes</label>



                                                </div>

                                                <div class="custom-control custom-radio">

                                                    <input type="radio" id="customRadio3" name="dbsdisclosure" class="custom-control-input" value="No" onclick="show1();">

                                                    <label class="custom-control-label" for="customRadio3">No</label>



                                                </div>

                                                <span class="text-danger" id="dbsdisclosure_error">{{ $errors->useredit->first('dbsdisclosure') }}</span>

                                                <div id="div1" class="hide">

                                                    <div class="main-file-box">

                                                        <div class="file-flex">

                                                            <input type="file" name="document_pdf" class="mb-0 blank-input file-input-box inputbar-padding" id="uploadFile">

                                                        </div>

                                                        <div class="main-file-uplode">

                                                            <!-- <div class="file-upload-box">

                                                                <input type="file" class="yes-no-radio" id="uploadBtn" name="document_pdf">

                                                            </div>

                                                            <div class="upload-img-box">

                                                                <img src="{{ asset('front/img/upload.png') }}" class="img-fluid upload-img">

                                                            </div> -->

                                                        </div>

                                                    </div>

                                                    <span class="text-danger" id="document_pdf_error"></span>

                                                </div>



                                            </div>

                                            <div class="col-md-6 mb-23">

                                                <h6 class="mb-2">Do you have tutoring experience in the UK?
                                                    (required)

                                                </h6>

                                                <div class="custom-control custom-radio">

                                                    <input type="radio" id="customRadio4" value="Yes" name="exprienceinuk" class="custom-control-input">

                                                    <label class="custom-control-label" for="customRadio4">Yes</label>

                                                </div>

                                                <div class="custom-control custom-radio">

                                                    <input type="radio" id="customRadio5" name="exprienceinuk" class="custom-control-input" value="No">

                                                    <label class="custom-control-label" for="customRadio5">No</label>

                                                </div>

                                                <span class="text-danger" id="exprienceinuk_error">{{ $errors->useredit->first('exprienceinuk') }}</span>

                                            </div>
                                            <div class="col-md-6 mb-23">

                                                <h6 class="mb-2">If yes, how much UK tutoring experience do you
                                                    have?

                                                    (required)

                                                </h6>

                                                <div class="custom-control custom-radio">

                                                    <input type="radio" id="customRadio6" name="tutorexperienceinuk" class="custom-control-input" value="1">

                                                    <label class="custom-control-label" for="customRadio6">1-2

                                                        years</label>

                                                </div>

                                                <div class="custom-control custom-radio">

                                                    <input type="radio" id="customRadio7" name="tutorexperienceinuk" class="custom-control-input" value="2">

                                                    <label class="custom-control-label" for="customRadio7">3-5

                                                        years</label>

                                                </div>

                                                <div class="custom-control custom-radio">

                                                    <input type="radio" id="customRadio8" name="tutorexperienceinuk" class="custom-control-input" value="3">

                                                    <label class="custom-control-label" for="customRadio8">5 plus

                                                        years</label>

                                                </div>

                                                <span class="text-danger" id="tutorexperienceinuk_error">{{ $errors->useredit->first('tutorexperienceinuk') }}</span>

                                            </div>
                                            <div class="col-md-6 mb-23">

                                                <h6 class="mb-2">Are you legally entitled to work in the UK?
                                                    Remember

                                                    you will be self-employed as a tutor and pay your own tax to the UK

                                                    Government. (required)</h6>

                                                <div class="custom-control custom-radio">

                                                    <input type="radio" id="customRadio11" value="Yes" name="paytax" class="custom-control-input">

                                                    <label class="custom-control-label" for="customRadio11">Yes</label>

                                                </div>

                                                <div class="custom-control custom-radio">

                                                    <input type="radio" id="customRadio10" value="No" name="paytax" class="custom-control-input">

                                                    <label class="custom-control-label" for="customRadio10">No</label>

                                                </div>

                                                <span class="text-danger" id="paytax_error">{{ $errors->useredit->first('paytax') }}</span>

                                            </div>

                                        </div>







                                        <div class="col-md-2 mb-23">

                                            <h6 class="mb-2">Upload your photo</h6>

                                            <div class="avatar-upload">



                                                <div class="avatar-preview">



                                                    <div id="imagePreview" style="background-image: url({{ asset('img/tutors/1.jpg') }});">

                                                    </div>

                                                </div>

                                                <div class="avatar-edit">

                                                    <input type="file" id="imageUpload" accept=".png, .jpg, .jpeg" name="profile_image">

                                                    <label for="imageUpload">upload</label>

                                                </div>

                                            </div>

                                            <span class="text-danger" id="profile_pic_error">{{ $errors->useredit->first('profile_image') }}</span>

                                        </div>

                                        <div class="col-md-5">
                                            <h6>User Name</h6>
                                            <input name="user_name" maxlength="30" class="mb-0" autocomplete="off" id="user_name" type="text" placeholder="User Name">

                                            <span id="user_name_error" class="text-danger">{{ $errors->useredit->first('user_name') }}</span>

                                        </div>

                                        <div class="col-md-5">
                                            <h6>Password</h6>
                                            <input name="password" class="mb-0" id="password" type="password" placeholder="Password">

                                            <span id="password_error" class="text-danger">{{ $errors->useredit->first('password') }}</span>

                                        </div>

                                        <div class="col-md-12 col-lg-12">

                                            <div class="form-check custom-check">

                                                <input class="form-check-input terms-condition" type="checkbox" name="term" id="term">


                                                <label class="form-check-label condition-text" for="defaultCheck1">
                                                    <a class="condition-text" href="{{url('terms-and-conditions')}}">Terms & conditions </a>

                                                </label>

                                            </div>
                                            <span class="text-danger" id="error_term"></span>

                                        </div>







                                        <div class="col-md-12">

                                            <div class="become-end-btn btn-end">

                                                <button type="submit" id="submitform" class="button-default">SUBMIT</button>

                                            </div>

                                        </div>

                                    </div>

                                </form>

                            </div>

                        </div>



                    </div>

                </div>

            </div>

        </div>



    </div>

    @include('frontend.testimonial.testmonial')
    <!--End of Breadcrumb Banner Area-->



    <!-- English Testimonials area Start-->



</div>
<span id="dropdowns_id" style="display:none">
    <option value="">Select Subject</option>

    @foreach ($subject_list as $val)
    <option value="{{ $val->id }}">{{ $val->main_title }}
    </option>
    @endforeach
</span>
<span id="tutor_level_id" style="display:none">
    <option value="">Select Tutor Level</option>

    @foreach ($tutor_level_list as $val)
    <option value="{{ $val->id }}">{{ $val->title }}
    </option>
    @endforeach
</span>
@endsection

@section('page-js')
<script src="{{ asset('front/js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('assets/js/toastr.min.js') }}"></script>

<script>
    $('.testimonial-english').owlCarousel({
        loop: false,
        margin: 10,
        nav: true,
        navText: ["<img src='{{ asset('front/img/svg/left-arrow-test.png') }}'>",
            "<img src='{{ asset('front/img/svg/right-arrow-test.png') }}'>"
        ],
        dots: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    })
</script>



<script>
    $('.extra-fields-customer').click(function() {

        var length = $('.copy_id').length;

        var mathRand = Math.floor(100000000 + Math.random() * 900000000);

        var htmlRep = '';

        htmlRep += '<div class="copy_id customer_records_dynamic remove" id="' + mathRand + '">' +

            '<div class="row form-data">' +

            '<div class="col-md-3">' +

            '<input name="university[]" class="mb-0" autocomplete="off" maxlength="35" data-id="' + mathRand +
            '" type="text" placeholder="University/Institution">' +

            '<span id="customer_name_' + mathRand + '_error" class="text-danger"></span>' +

            '</div>' +

            '<div class="col-md-3">' +

            '<input name="qualification[]" class="mb-0" autocomplete="off" maxlength="35" data-id="' + mathRand +
            '" type="text" placeholder="Qualification">' +

            '<span id="qualification' + mathRand + '_error" class="text-danger"></span>' +

            '</div>' +

            '<div class="col-md-5">' +

            '<div class="downloaded-file position-relative">' +

            '<div class="chemistry-icon-text">    <div class="input-file-bio"> <p type="text" id="uploadeviFile" class="input-upload-bio mt-0 mb-0"> </p> </div> <input type="file"  class="bio-input-fild mb-0 inputbar-padding" name="document_certi[]" id="uploadeviBtn" data-id="' +
            mathRand + '" ><span id="document_certi' + mathRand + '_error" class="text-danger"></span>' +



            '</div>' +

            '</div>' +

            '</div>' +

            '<div class="col-md-1  add"> <a href="javascript:void(0)" class="remove-field btn-remove-customer" onclick="remove(' +
            mathRand + ')"><i class="fa fa-minus fa-icon search-menu2" aria-hidden="true"></i></a></div>' +

            '</div>' +

            '</div>';

        $('#main_id').append(htmlRep);

    });


    function remove(id) {
        $('#' + id).remove();
    }
</script>

<script>
    function show1() {

        var names = $('input[name="dbsdisclosure"]:checked').val();

        if (names == 'Yes') {

            document.getElementById('div1').style.display = 'block';

        } else {

            document.getElementById('div1').style.display = 'none';

        }



    }



    //---------------------z

    $(document).ready(function() {

        document.getElementById("uploadBtn").onchange = function() {

            document.getElementById("uploadFile").value = this.value;

        };

    });
</script>

<script>
    function readURL(input) {

        if (input.files && input.files[0]) {

            var reader = new FileReader();

            reader.onload = function(e) {

                $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');

                $('#imagePreview').hide();

                $('#imagePreview').fadeIn(650);

            }

            reader.readAsDataURL(input.files[0]);

        }

    }

    $("#imageUpload").change(function() {

        readURL(this);

    });
</script>

<script>
    function ValidateEmail(email) {
        var expr =
            /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        return expr.test(email);
    }

    function ValidatePassword(password) {
        var expr = /^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!@$#%&*]).{6,}$/;
        return expr.test(password);
    }
    $("#email").keyup(function() {
        var emailVal = $("#email").val();
        $("#user_name").val(emailVal);
    });
    $("#formdata").submit(function() {

        var name = $("#name").val();

        var email = $("#email").val();

        var mobile = $("#mobile").val();

        var address1 = $("#address1").val();

        var address2 = $("#address2").val();

        var address3 = $("#address3").val();

        var city = $("#city").val();

        var postcode = $("#postcode").val();

        var bio = $("#bio").val();

        var profile_image = $("#imageUpload").prop('files');

        var subject = $('select[name="subject[]"]').val();

        var level = $('select[name="level[]"]').val();

        var disclose = $('input[name="dbsdisclosure"]').is(":checked");

        var exprienceinuk = $('input[name="exprienceinuk"]').is(":checked");

        var tutorexperienceinuk = $('input[name="tutorexperienceinuk"]').is(":checked");

        var paytax = $('input[name="paytax"]').is(":checked");

        var document_pdf = $('input[name="document_pdf"]').prop('files');
        var userName = $("#user_name").val();
        var password = $("#password").val();


        var term = $("#term").val();

        var temp = 0;

        $("#error_name").html('');

        $("#error_email").html('');

        $("#error_mobile").html('');

        $("#error_address1").html('');

        $("#error_address2").html('');

        $("#error_address3").html('');

        $("#error_city").html('');

        $("#error_postcode").html('');

        $("#error_bio").html('');

        $("#error_profile_image").html('');

        $("#subject_error").html('');

        $("#level_error").html('');
        $("#user_name_error").html('');
        $("#password_error").html('');

        $("#error_term").html('');


        if (userName.trim() == '') {

            $('#user_name_error').html('Please enter username');

            temp++;

        }
        if (password.trim() == '') {
            $('#password_error').html('Please enter password');
            temp++;
        } else {
            if (!ValidatePassword(password)) {
                $("#password_error").html("Password should include 6 charaters, alphabets, numbers and special characters");
                temp++;
            }
        }
        if (name.trim() == '') {

            $('#error_name').html('Please enter name');

            temp++;

        }



        if (email == '') {

            $('#error_email').html('Please enter email');

            temp++;

        } else {

            if (!ValidateEmail(email)) {

                $('#error_email').html("Invalid email");

                temp++;

            } else {

                $.ajax({

                    async: false,

                    global: false,

                    url: "{{ route('check.email') }}",

                    type: "get",

                    data: {

                        email: email

                    },

                    success: function(response) {

                        if (response.status == 1) {

                            $('#error_email').html("Email is already exist");

                            temp++;



                        } else {

                            $('#error_email').html("");

                        }

                    }

                });

            }

        }



        if (mobile.trim() == '') {

            $('#error_mobile').html('Please enter mobile');

            temp++;

        }

        if (address1.trim() == '') {

            $('#error_address1').html('Please enter address1');

            temp++;

        }

        if (address2.trim() == '') {

            $('#error_address2').html('Please enter address2');

            temp++;

        }

        if (address3.trim() == '') {

            $('#error_address3').html('Please enter address3');

            temp++;

        }

        if (city.trim() == '') {

            $('#error_city').html('Please enter city');

            temp++;

        }

        if (postcode.trim() == '') {

            $('#error_postcode').html('Please enter postcode');

            temp++;

        }

        if (bio.trim() == '') {

            $('#error_bio').html('Please enter bio');

            temp++;

        }





        if (profile_image.length == 0) {

            $('#profile_pic_error').html('Please select profile image');

            temp++

        }


        if (profile_image.length != 0) {

            var FileUploadPath = profile_image[0].name;

            var Extension = FileUploadPath.substring(FileUploadPath.lastIndexOf('.') + 1).toLowerCase();



            if (Extension == 'jpg' || Extension == 'png' || Extension == 'gif' || Extension == 'jpeg') {

                $('#profile_pic_error').html("");

            } else {

                $('#profile_pic_error').html("Photo only allows image types of PNG, JPG, JPEG");

                temp++;

            }

        }

        $('input[name="university[]"]').each(function(e) {

            var dataId = $(this).attr('data-id');

            var value = $(this).val();

            $('#customer_name_' + dataId + '_error').html("");

            if (value.trim() == '') {

                $('#customer_name_' + dataId + '_error').html("Please enter university/institution");

                temp++;

            }

        })

        $('input[name="qualification[]"]').each(function(e) {

            var dataId = $(this).attr('data-id');

            var value = $(this).val();

            $('#qualification' + dataId + '_error').html("");

            if (value.trim() == '') {

                $('#qualification' + dataId + '_error').html("Please enter qualification");

                temp++;

            }

        })

        $('input[name="document_certi[]"]').each(function(e) {

            var dataId = $(this).attr('data-id');

            var value = $(this).prop('files');

            $('#document_certi' + dataId + '_error').html("");

            if (value.length == 0) {

                $('#document_certi' + dataId + '_error').html("Please upload certificate");

                temp++;

            } else {

                var FileUploadPath = value[0].name;

                var Extension = FileUploadPath.substring(FileUploadPath.lastIndexOf('.') + 1)
                    .toLowerCase();



                if (Extension == 'pdf') {



                } else {

                    $('#document_certi' + dataId + '_error').html("Only Pdf Allowed");

                    temp++;

                }

            }

        })
        $('#dbsdisclosure_error').html('');

        if (disclose == false) {

            $('#dbsdisclosure_error').html('Please select DBS disclosure');

            temp++

        } else {

            var disclosed = $('input[name="dbsdisclosure"]:checked').val();

            if (disclosed == "Yes") {

                if (document_pdf.length == 0) {

                    $('#document_pdf_error').html("Please upload document");

                    temp++

                }

            }

        }

        $('input[name="main_subject_id[]"]').each(function(e) {
            var dataId = $(this).val();
            var dataValue = $('#sub' + dataId).val();
            var level = $('select[name="level' + dataId + '[]"]').val();
            $('#level_' + dataId + '_error').html("");
            $('#subject_' + dataId + '_error').html("");
            console.log(dataValue + "vishal");
            if (dataValue == '') {
                $('#subject_' + dataId + '_error').html("Please select subject");
                temp++
            }

            if (level == null) {
                $('#level_' + dataId + '_error').html("Please select tutor level");
                temp++
            }
        })

        if (exprienceinuk == false) {

            $('#exprienceinuk_error').html('Please select tutoring experience');

            temp++

        }

        if (tutorexperienceinuk == false) {

            $('#tutorexperienceinuk_error').html('Please select UK tutoring experience');

            temp++

        }

        if (paytax == false) {

            $('#paytax_error').html('Please select tutor and pay your own tax');

            temp++

        }
        if ($("input[name='term']:checked").length == 0) {
            $('#error_term').html('Please select Term & condition');
            temp++
        }


        if (temp == 0) {
            return true;

        } else {
            return false;

        }

    });


    //--------------------
    $(document).ready(function() {
        // document.getElementById("uploadeviBtn").onchange = function() {
        //     $("#uploadeviFile").html(this.value);
        // };
    });

    function addmoreSubject() {

        var length = $('.copy_subject_id').length;

        var mathRandSubject = Math.floor(100000000 + Math.random() * 900000000);

        var htmlRep = '';
        var dropdowns = $('#dropdowns_id').html();
        var level_id = $('#tutor_level_id').html();
        htmlRep += '<div class="copy_subject_id" id="' + mathRandSubject + '" style="margin-top: 10px;"><input type="hidden" name="main_subject_id[]" value="' + mathRandSubject + '">' +
            '<div class="row">' +
            '<div class="col-md-6">' +
            '<div class="subject-custom">' +
            '<select class="selectpicker" id="sub' + mathRandSubject + '" name="subject' + mathRandSubject + '[]" data-id="' + mathRandSubject + '" aria-label="Default select example" data-live-search="true">' + dropdowns + '</select>' +
            '<span class="text-danger" id="subject_' + mathRandSubject + '_error"></span></div></div>' +
            '<div class="col-md-5"> <div class="subject-custom"><select class="selectpicker" data-id="' + mathRandSubject + '" name="level' + mathRandSubject + '[]" multiple aria-label="Default select example" data-live-search="true">' + level_id + '</select><span class="text-danger" id="level_' + mathRandSubject + '_error"></span></div></div>' +
            '<div class="col-md-1 add-subject"><a href="javascript:void(0)" style="margin-top:-3%;" class="remove-field btn-remove-customer btn-remove-customer2" onclick="removeSubject(' + mathRandSubject + ')"><i class="fa fa-minus fa-icon search-menu2" aria-hidden="true"></i></a></div></div></div>';

        $('#subjects_id').append(htmlRep);
        $('.selectpicker').selectpicker();
    }

    function removeSubject(id) {
        $('#' + id).remove();
    }
</script>
<script>
    @if(Session::has('success'))
    toastr.success("{{ session('success') }}");
    @endif

    @if(Session::has('error'))
    toastr.error("{{ session('error') }}");
    @endif

    @if(Session::has('info'))
    toastr.info("{{ session('info') }}");
    @endif

    @if(Session::has('warning'))
    toastr.warning("{{ session('warning') }}");
    @endif
</script>
@endsection