@extends('layouts.frontend')
@section('content')
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

                                    <!-- <div class="banner-readmore">
                                                <a class="button-default inline" href="find-tutor.html">Find a Tutors</a>
                                            </div> -->
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
                        <!-- <h5 class="we-inter">We are interested in hearing from experienced private tutors who can educate, guide and inspire students of all ages and levels.</h5> -->
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
                                    <!-- <h4 class="mb-3">Science Clinic Private Tutoring Ltd Application Form
                                        </h4> -->
                                    <h4 class="mb-3">Apply To Tutor With Science Clinic Private Tutors
                                    </h4>
                                </div>
                            </h4>
                            <div class="contact-form-area">
                                <form action="{{route('become-tutor.store')}}" method="POST" enctype="multipart/form-data" id="formdata">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="text" name="name" id="name" placeholder="Name">
                                            <span class="text-danger" id="error_name"></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="email" id="email" placeholder="Email">
                                            <span class="text-danger" id="error_email"></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="mobile" id="mobile" placeholder="Telephone">
                                            <span class="text-danger" id="error_mobile"></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="address1" id="address1" placeholder="Address 1">
                                            <span class="text-danger" id="error_address1"></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="address2" id="address2" placeholder="Address 2">
                                            <span class="text-danger" id="error_address2"></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="address3" id="address3" placeholder="Address 3">
                                            <span class="text-danger" id="error_address3"></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="city" id="city" placeholder="Town/City">
                                            <span class="text-danger" id="error_city"></span>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="postcode" id="postcode" placeholder="Postcode">
                                            <span class="text-danger" id="error_postcode"></span>
                                        </div>
                                        <div class="col-md-12">
                                            <textarea name="bio" id="bio" cols="30" rows="10" placeholder="Bio
                                                "></textarea>
                                            <span class="text-danger" id="error_bio"></span>

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
                                                <div class="row">
                                                    <div class="col-md-3"><input name="customer_name" type="text" placeholder="University/Institution"></div>
                                                    <div class="col-md-3"><input name="customer_name" type="text" placeholder="Qualification"></div>
                                                    <div class="col-md-3">
                                                        <div class="downloaded-file">
                                                            <div class="chemistry-icon-text">
                                                                <button type="button" class="btn download-pdfs uplod"><i class="fa fa-book mr-2"></i>Certificates-1</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 add"> <a class="extra-fields-customer search-menu" href="javascript:void(0)"><i class="fa fa-plus fa-icon" aria-hidden="true"></i></a></div>
                                                </div>

                                              

                                            </div>

                                            <div class="customer_records_dynamic"></div>

                                        </div>
                                        <div class="col-md-6 mb-23 mt-13px">
                                            <h6 class="mb-2">Subject you wish to tutor. (required)</h6>
                                            <!-- <label class="tutor-label">Subject</label> -->
                                            <div class="subject-custom">

                                                <select class="selectpicker" multiple aria-label="Default select example" data-live-search="true">

                                                    <option value="1" selected>Accounting</option>
                                                    <option value="2">Arabic</option>
                                                    <option value="3">Art</option>
                                                    <option value="4">Biology</option>
                                                    <option value="5">Business Studies</option>
                                                    <option value="6">Chemistry</option>
                                                    <option value="7">Computer Science</option>
                                                    <option value="8">Drama</option>
                                                    <option value="9">Economics</option>
                                                    <option value="10">English Language</option>
                                                    <option value="11">English Literature</option>
                                                    <option value="12">ESL</option>
                                                    <option value="13">French</option>
                                                    <option value="14">Geography</option>
                                                    <option value="15">German</option>
                                                    <option value="16">History</option>
                                                    <option value="17">International Baccalaureate (IB)</option>
                                                    <option value="18">Italian</option>
                                                    <option value="19">Law</option>
                                                    <option value="20">Maths</option>
                                                    <option value="21">Mechanics</option>
                                                    <option value="22">Physics</option>
                                                    <option value="23">Politics</option>
                                                    <option value="24">Psychology</option>
                                                    <option value="25">Russian</option>
                                                    <option value="26">Science</option>
                                                    <option value="27">Sociology</option>
                                                    <option value="28">Spanish</option>
                                                    <option value="29">Statistics</option>

                                                </select>

                                            </div>

                                        </div>
                                        <div class="col-md-6 mb-23">

                                            <h6 class="mb-2">Level you wish to tutor. (required)</h6>
                                            <!-- <label class="tutor-label">Level of Tuition</label> -->
                                            <div class="subject-custom">
                                                <select class="selectpicker" multiple aria-label="Default select example" data-live-search="true">
                                                    <option value="levels" selected>A-level (Years 12 & 13)
                                                    </option>
                                                    <option value="gcse">GCSE/ IGCSE (Years 9,10 & 11)
                                                    </option>
                                                    <option value="ks3">KS3 (Years 7 & 8) </option>
                                                    <option value="ks2">KS2 (Years 4, 5 & 6) </option>
                                                    <option value="ks1">KS1 (Years 1, 2, & 3) </option>
                                                    <option value="scottish">Scottish Highers (S5) </option>
                                                    <option value="national">National 5 (S4) </option>
                                                    <option value="ib">IB </option>
                                                    <option value="adult">Adult learning & Functional Skills
                                                    </option>
                                                    <option value="plus1">11+ </option>
                                                    <option value="plus">13+ </option>
                                                    <option value="common">Common entrance Exam </option>
                                                    <option value="primary">Primary </option>
                                                    <option value="p1">P1 - P7 (Scottish Primary)</option>
                                                    <option value="s1">S1 - S3 (Scottish Secondary)
                                                    </option>
                                                </select>
                                            </div>
                                        </div>




                                        <div class="col-md-6 mb-23">
                                            <h6 class="mb-2">Do you have an enhanced DBS disclosure (less than a
                                                year old)? (required)</h6>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="customRadio2" value="Yes" name="dbsdisclosure" class="custom-control-input" onclick="show1();">
                                                <label class="custom-control-label" for="customRadio2">Yes</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="customRadio3" name="dbsdisclosure" class="custom-control-input" value="No" onclick="show2();">
                                                <label class="custom-control-label" for="customRadio3">No</label>
                                            </div>
                                            <div id="div1" class="hide">
                                                <div class="main-file-box">
                                                    <div class="file-flex">
                                                        <input class="blank-input file-input-box" id="uploadFile" type="text">
                                                    </div>
                                                    <div class="main-file-uplode">
                                                        <div class="file-upload-box">
                                                            <input type="file" class="yes-no-radio" id="uploadBtn" name="document_pdf">
                                                        </div>
                                                        <div class="upload-img-box">
                                                            <img src="{{asset('front/img/upload.png')}}" class="img-fluid upload-img">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-23">
                                            <h6 class="mb-2">Do you have tutoring experience in the UK? (required)
                                            </h6>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="customRadio4" value="Yes" name="exprienceinuk" class="custom-control-input">
                                                <label class="custom-control-label" for="customRadio4">Yes</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="customRadio5" name="exprienceinuk" class="custom-control-input" value="No">
                                                <label class="custom-control-label" for="customRadio5">No</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-23">
                                            <h6 class="mb-2">If yes, how much UK tutoring experience do you have?
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

                                        </div>
                                        <div class="col-md-6 mb-23">
                                            <h6 class="mb-2">Are you legally entitled to work in the UK? Remember
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
                                        </div>
                                        <div class="col-md-2 mb-23">
                                            <h6 class="mb-2">Upload your photo</h6>
                                            <div class="avatar-upload">
                                                    
                                                <div class="avatar-preview">

                                                    <div id="imagePreview" style="background-image: url({{asset('img/tutors/1.jpg')}});">
                                                    </div>
                                                </div>
                                                <div class="avatar-edit">
                                                    <input type="file" id="imageUpload" accept=".png, .jpg, .jpeg">
                                                    <label for="imageUpload">upload</label>
                                                </div>
                                            </div>
                                            
                                        </div>

                                        <div class="col-md-12 col-lg-12">
                                            <div class="form-check custom-check">
                                                <input class="form-check-input terms-condition" type="checkbox" value="1" name="term" id="term">
                                                <span class="text-danger" id="error_term"></span>
                                                <label class="form-check-label condition-text" for="defaultCheck1">
                                                    <a class="condition-text" href="terms-and-conditions.html">Terms & conditions </a>
                                                </label>
                                            </div>
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



    <div class="testimonial-section pt-0">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 offset-lg-0 col-md-12 col-12">
                    <div class="owl-carousel owl-theme testimonial-english">
                        <div class="item">

                            <div class="card single-product-item">
                                <div class="card-body single-product-text card-pdtestimonial">
                                    <div class="content-slideeng">
                                        <div class="slider-feedsec">
                                            <div class="quotes-testi testi1">
                                                <img src="{{asset('front/img/svg/left-quotes.png')}}" alt="left-quotes">
                                            </div>
                                            <div class="max-textquote">
                                                <p class="mb-0 we-likep">
                                                    We would like to pass on our feedback and show appreciation for
                                                    Mr Hamalabi from Science Clinic Private Tutoring Ltd who worked
                                                    with our daughter and improved her Chemistry & Physics skills in
                                                    the run up to her GCSE exams He was only with us for a short
                                                    time but the work he did in that short period of time was
                                                    unbelievable. Kayleigh got A* in both subjects.

                                                </p>
                                                <p class="float-right writer-text">
                                                    - B.K. Thomas
                                                </p>
                                            </div>
                                            <div class="quotes-testi testi2">
                                                <img src="{{asset('front/img/svg/right-quotes.png')}}" alt="right-quotes">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="card single-product-item">
                                <div class="card-body single-product-text card-pdtestimonial">
                                    <div class="content-slideeng">
                                        <div class="slider-feedsec">
                                            <div class="quotes-testi testi1">
                                                <img src="{{asset('front/img/svg/left-quotes.png')}}" alt="left-quotes">
                                            </div>
                                            <div class="max-textquote">
                                                <p class="mb-0 we-likep">
                                                    Thank you Science Clinic Private Tutoring Ltd for your prompt
                                                    and efficient service. It was so simple, I wish we had found you
                                                    sooner.

                                                </p>
                                                <p class="float-right writer-text">
                                                    - C.H. (Colchester)
                                                </p>
                                            </div>
                                            <div class="quotes-testi testi2">
                                                <img src="{{asset('front/img/svg/right-quotes.png')}}" alt="right-quotes">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="card single-product-item">
                                <div class="card-body single-product-text card-pdtestimonial">
                                    <div class="content-slideeng">
                                        <div class="slider-feedsec">
                                            <div class="quotes-testi testi1">
                                                <img src="{{asset('front/img/svg/left-quotes.png')}}" alt="left-quotes">
                                            </div>
                                            <div class="max-textquote">
                                                <p class="mb-0 we-likep">
                                                    Can't believe how quickly this has worked. I went on the
                                                    Internet on 15th January and Chloe had a lesson today with Mr
                                                    Hamalabi who is only 5 minutes drive away from us. We are so
                                                    pleased and delighted.

                                                </p>
                                                <p class="float-right writer-text">
                                                    - J.J. Brown
                                                </p>
                                            </div>
                                            <div class="quotes-testi testi2">
                                                <img src="{{asset('front/img/svg/right-quotes.png')}}" alt="right-quotes">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="card single-product-item">
                                <div class="card-body single-product-text card-pdtestimonial">
                                    <div class="content-slideeng">
                                        <div class="slider-feedsec">
                                            <div class="quotes-testi testi1">
                                                <img src="{{asset('front/img/svg/left-quotes.png')}}" alt="left-quotes">
                                            </div>
                                            <div class="max-textquote">
                                                <p class="mb-0 we-likep">
                                                    I would like you to know how delighted we have been with Mr
                                                    Hamalabi who has provided home tuitions in Physics, Mathematics
                                                    & Chemistry to my daughter for 3 years. She went from C grade at
                                                    the end of year 9 to getting A*, A & A respectively in her GCSE.

                                                </p>
                                                <p class="float-right writer-text">
                                                    - J.C. Paula
                                                </p>
                                            </div>
                                            <div class="quotes-testi testi2">
                                                <img src="{{asset('front/img/svg/right-quotes.png')}}" alt="right-quotes">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="card single-product-item">
                                <div class="card-body single-product-text card-pdtestimonial">
                                    <div class="content-slideeng">
                                        <div class="slider-feedsec">
                                            <div class="quotes-testi testi1">
                                                <img src="{{asset('front/img/svg/left-quotes.png')}}" alt="left-quotes">
                                            </div>
                                            <div class="max-textquote">
                                                <p class="mb-0 we-likep">
                                                    We are grateful to Mr Hamalabi from Science Clinic Private
                                                    Tutoring Ltd for giving Tom confidence and for assisting him
                                                    greatly in improving his performance to the level of getting A &
                                                    A* in Biology, Chemistry & Physics.

                                                </p>
                                                <p class="float-right writer-text">
                                                    - C.K. Tommy
                                                </p>
                                            </div>
                                            <div class="quotes-testi testi2">
                                                <img src="{{asset('front/img/svg/right-quotes.png')}}" alt="right-quotes">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End of Breadcrumb Banner Area-->

    <!-- English Testimonials area Start-->

</div>



@endsection
@section('page-js')
<script src="{{asset('front/js/bootstrap-select.min.js')}}"></script>

<!-- bootstrap-select. -->
<script>
    $('.testimonial-english').owlCarousel({
        loop: true,
        margin: 10,
        nav: true,
        navText: ["<img src='{{asset('front/img/svg/left-arrow-test.png')}}'>", "<img src='{{asset('front/img/svg/right-arrow-test.png')}}'>"],
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
        $('.customer_records').clone().appendTo('.customer_records_dynamic');
        $('.customer_records_dynamic .customer_records').addClass('single remove');
        $('.single .extra-fields-customer').remove();
        $('.single').append('<a href="#" class="remove-field btn-remove-customer"><i class="fa fa-minus fa-icon search-menu2" aria-hidden="true"></i></a>');
        $('.customer_records_dynamic > .single').attr("class", "remove");

        $('.customer_records_dynamic input').each(function() {
            var count = 0;
            var fieldname = $(this).attr("name");
            $(this).attr('name', fieldname + count);
            count++;
        });

    });

    $(document).on('click', '.remove-field', function(e) {
        $(this).parent('.remove').remove();
        e.preventDefault();
    });
</script>




<script>
    //header footer script
    $(document).ready(function() {
        $("#header").load("header.html");
    });

    $(document).ready(function() {
        $("#footer").load("footer.html");
    });
</script>

<script>
    function show1() {
        document.getElementById('div1').style.display = 'block';
    }

    function show2() {
        document.getElementById('div1').style.display = 'none';
    }
    //---------------------
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
        var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        return expr.test(email);

    }

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
        // var term = $("#term").val();
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
        // $("#error_term").html('');

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
                    url: "{{route('check.email')}}",
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
            $('#error_profile_image').html('Required');
            temp++
        }

        if (temp == 0) {
            return true;
        } else {
            return false;
        }
    });
</script>

@endsection