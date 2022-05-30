@extends('layouts.frontend')
@section('content')
    <style>
        .banner-content,
        .banner-content .container,
        .banner-content .row,
        .banner-content .col-md-12,
        .banner-content .text-content-wrapper,
        .banner-content .text-content {
            height: 65%;
            margin: auto;
        }

    </style>
    <style>
        .error{
            color:red;
        }
        </style>
    <!--Main Wrapper Start-->
    <div class="as-mainwrapper">
        <!--Bg White Start-->
        <div class="bg-white">
            <!--Header Area Start-->
            <div id="header"></div>
            <!--End of Header Area-->

            <div class="backgrount-area  contact-bg full-grayoverlay">
                <div class="banner-content padding-headsection">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="text-content-wrapper text-center full-width">
                                    <div class="text-content text-center-content">
                                        <h1 class="title1 text-center max-englishtext mb-20">
                                            <span class="tlt block" data-in-effect="fadeInRight"
                                                data-out-effect="fadeOutRight">Contact Us</span>
                                        </h1>
                                        <p>
                                            If you are looking for an experienced, knowledgeable and dedicated private tutor
                                            who has full knowledge of the National Curriculum for your child, please get in
                                            touch
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--End of Breadcrumb Banner Area-->
            <!--Contact Form Area Start-->
            <div class="contact-form-area section-padding">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-12">
                            <h4 class="contact-title">contact info</h4>
                            <div class="contact-text">
                                <div class="d-flex-contact">
                                    <div class="c-icon contact-icon">
                                        <i class="zmdi zmdi-phone "></i>
                                    </div>
                                    <div class="flex-column-contact">
                                        <span class="c-text">
                                            <p class="title-contact">Office</p><a href="tel:01245352101">01245352101</a>
                                        </span>
                                        <span class="c-text">
                                            <p class="title-contact">Mobile:</p><a href="tel:07572505997">07572505997</a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="position-relative">
                                <h4 class="contact-title">social media</h4>
                                <div class="link-social custom-link">
                                    <a href="https://www.facebook.com/scienceclinicuk/"><i
                                            class="zmdi zmdi-facebook"></i></a>
                                    <a href="https://twitter.com/science_clinic"><i class="zmdi zmdi-twitter"></i></a>
                                    <a
                                        href="https://www.linkedin.com/company/science-clinic-private-tutoring-ltd/about/?viewAsMember=true"><i
                                            class="zmdi zmdi-linkedin"></i></i></a>
                                    <a href="https://www.pinterest.co.uk/scienceclinicprivatetutoringlt/_saved/"><i
                                            class="zmdi zmdi-pinterest"></i></a>
                                    <a href="https://www.youtube.com/channel/UCH2RIsc56umKg_Li4HaF_VQ"><i
                                            class="zmdi zmdi-youtube"></i></a>
                                </div>
                            </div>
                            <span class="footer-add mt-4"><span>39 Moulsham Street<br>Chelmsford<br>
                                    Essex<br>CM2 0HY</span>
                            </span>
                            <div class="mt-5">
                                <p><span style="font-weight: 700;">Please Note :</span> That all lessons are conducted in
                                    the comfort of your home and there should be a responsible adult present at home during
                                    this period.</p>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-12">
                            <h4 class="contact-title">send your massage</h4>
                            <form id="contact-form" action="{{ route('contact.store') }}" method="POST">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="text" name="name" placeholder="Name" id="name">

                                        <span class="error" id="name_error"></span>

                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="phone_no" placeholder="Phone No" id="phone_no">
                                        <span class="error" id="phone_error"></span>
                                    </div>
                                    <div class="col-md-6">
                                        <select name="tutor_type" id="tutor_type">
                                            <option>
                                                Tutor Type
                                            </option>
                                            <option>
                                                Face to Face Tution
                                            </option>
                                            <option>
                                                Online Tution
                                            </option>
                                        </select>
                                        <span class="error" id="tutor_error"></span>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="email" name="email" placeholder="Email" id="email">
                                        <span class="error" id="email_error"></span>
                                    </div>
                                    <div class="col-md-12">
                                        <textarea name="message" cols="30" rows="10" placeholder="Message" id='message'></textarea>
                                        <span class="error" id="message_error"></span>
                                        <button type="button" class="button-default" id="add_contact">SUBMIT</button>
                                    </div>
                                </div>
                            </form>
                            {{-- <p class="form-messege"></p> --}}
                        </div>
                    </div>
                </div>
            </div>
            <!--End of Contact Form-->
            <!-- English Testimonials area Start-->
            @include('frontend.testimonial.testmonial')
            <!--End of Breadcrumb Banner Area-->

            <!--Footer Area Start-->
            <div id="footer"></div>
            <!--End of Footer Area-->
        </div>
        <!--End of Bg White-->
    </div>
    <!--End of Main Wrapper Area-->
@endsection
@section('page-js')
    
    <script>
        var _Add_SUBJECT = "{{ route('contact.store') }}";
    </script>
    <script>
        $('#add_contact').click(function(e) {

            var name = $('#name').val();
            var phone_no = $('#phone_no').val();
            var email = $('#email').val();
            var tutor_type = $('#tutor_type').val();
            var email = $('#email').val();

            var cnt = 0;
            $('#name_error').html("");
            if (name.trim() == '') {
                $('#name_error').html("Name is required");
                
            }
            $('#phone_error').html("");
            if (phone_no.trim() == '') {
                $('#phone_error').html("Phone is required");
               
            }
            $('#tutor_error').html("");
            if (tutor_type.trim() == '') {
                $('#tutor_error').html("Tutor Type is required");   
            }
            $('#email_error').html("");
            if (email.trim() == '') {
                $('#email_error').html("Email is required");
            }
            $('#message_error').html("");
            if (message.trim() == '') {
                $('#message_error').html("Message is required");
            }  cnt = 1;
            console.log(cnt);
            if (cnt == 1) {
                return false;
            } else {
                $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('input[name="_token"]').attr('value') }
    });
                $.ajax({
                    url: _Add_SUBJECT,
                    type: "POST",
                    data: {
                        _token: '{{ csrf_token() }}',
                        name: name,
                        phone_no: phone_no,
                        tutor_type: tutor_type,
                        email: email,
                        messages: messages,
                        page: page,
                        created_at: created_at,
                    },
                    contentType: false,
                processData: false,
                dataType: "json",
                    success: function(response) {
                        console.log(response);
                        toastr.success(response.messages);
                    },
                    error: function(response) {
                        toastr.success(response.messages);
                    }
                });
            }
        })
    </script>
@endsection
