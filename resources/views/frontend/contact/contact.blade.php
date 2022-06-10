@extends('layouts.frontend')
@section('content')
<style>
    .banner-content,
    .banner-content .container,
    .banner-content .row,
    .banner-content .col-md-12,
    .banner-content .text-content-wrapper,
    .banner-content .text-content {
        height: max-content;
        margin: auto;
    }
</style>
<style>
    .error {
        color: red;
    }

    .form-data .col-md-6,
    .form-data .col-md-12 {
        margin-bottom: 23px;
    }
</style>
<link href="{{ asset('assets/css/toastr.css') }}" rel="stylesheet" />


{{-- toastr js --}}



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
                                        <span class="tlt block" data-in-effect="fadeInRight" data-out-effect="fadeOutRight">Contact Us</span>
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
                                <a href="https://www.facebook.com/scienceclinicuk/"><i class="zmdi zmdi-facebook"></i></a>
                                <a href="https://twitter.com/science_clinic"><i class="zmdi zmdi-twitter"></i></a>
                                <a href="https://www.linkedin.com/company/science-clinic-private-tutoring-ltd/about/?viewAsMember=true"><i class="zmdi zmdi-linkedin"></i></i></a>
                                <a href="https://www.pinterest.co.uk/scienceclinicprivatetutoringlt/_saved/"><i class="zmdi zmdi-pinterest"></i></a>
                                <a href="https://www.youtube.com/channel/UCH2RIsc56umKg_Li4HaF_VQ"><i class="zmdi zmdi-youtube"></i></a>
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
                            @csrf
                            <div class="row form-data">
                                <div class="col-md-6 ">
                                    <input type="text" class="mb-0" autocomplete="off" name="name" placeholder="Name" id="name" onkeypress='return isName(event) ' maxlength="255">
                                    <span class="error" id="name_error">{{ $errors->first('name') }}</span>

                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="mb-0" autocomplete="off" name="phone_no" placeholder="Phone No" id="phone_no" onkeypress='return isNumber(event)' maxlength="12">
                                    <span class="error" id="phone_error">{{ $errors->first('phone_no') }}</span>
                                </div>
                            </div>
                            <div class="row form-data">
                                <div class="col-md-6">
                                    <select name="tutor_type" id="tutor_type" class="mb-0">
                                        <option value="">Select Type</option>
                                        <option value="Tutor Type">
                                            Tutor Type
                                        </option>
                                        <option value="Face to Face Tution">
                                            Face to Face Tution
                                        </option>
                                        <option value="Online Tution">
                                            Online Tution
                                        </option>
                                    </select>
                                    <span class="error" id="tutor_type_error"></span>
                                </div>
                                <div class="col-md-6">
                                    <input type="email" class="mb-0" autocomplete="off" name="email" placeholder="Email" id="email">
                                    <span class="error mt-0" id="email_error">{{ $errors->first('email') }}</span>
                                </div>
                                <div class="col-md-12">
                                    <input type="address" class="mb-0" autocomplete="off" name="address" placeholder="Address" id="address">
                                    <span class="error mt-0" id="address_error">{{ $errors->first('address') }}</span>
                                </div>
                                <div class="col-md-12">
                                    <textarea name="message" class="mb-0" autocomplete="off" autocomplete="off" cols="30" rows="10" placeholder="Message" id='message'></textarea>
                                    <span class="error" id="message_error">{{ $errors->first('message') }}</span>
                                </div>
                                <div class="col-md-12">
                                    <button type="button" class="button-default" id="btn-save" title="Submit">Submit
                                    </button>
                                </div>
                            </div>
                        </form>
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
    var _Add_SUBJECT = "{{ route('contact.store') }}";
</script>
<script>
    function ValidateEmail(email) {
        var expr =
            /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        return expr.test(email);

    }

    $('#btn-save').click(function(e) {

        var name = $('#name').val();
        var phone_no = $('#phone_no').val();
        var tutor_type = $('#tutor_type').val();
        var email = $('#email').val();
        var address = $('#address').val();
        var message = $('#message').val();

        var temp = 0;

        if (name.trim() == '') {
            $('#name_error').html("Name is required");
            temp++;
        } else {
            $('#name_error').html("");
        }
        if (phone_no.trim() == '') {
            $('#phone_error').html("Phone No is required");
            temp++;
        } else {
            $('#phone_error').html("");
        }
        if (tutor_type.trim() == '') {
            $('#tutor_type_error').html("Type is required");
            temp++;
        } else {
            $('#tutor_type_error').html("");
        }
        if (email.trim() == '') {
            $('#email_error').html("Email is required");
            temp++;
        } else {
            if (!ValidateEmail(email)) {
                $('#email_error').html("Invalid email");
                temp++;
            } else {
                $('#email_error').html("");
            }
        }
        if (address.trim() == '') {
            $('#address_error').html("Address is required");
            temp++;
        } else {
            $('#address_error').html("");
        }

        if (message.trim() == '') {
            $('#message_error').html("Message is required");
            temp++;
        } else {
            $('#message_error').html("");
        }

        if (temp == 0) {


            $.ajax({
                url: _Add_SUBJECT,
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    name: name,
                    phone_no: phone_no,
                    tutor_type: tutor_type,
                    email: email,
                    address: address,
                    message: message
                },
                dataType: "json",
                success: function(data) {

                    toastr.success(data.error_msg);
                    $('#contact-form')[0].reset();
                },
                error: function(response) {
                    toastr.success(data.error_msg);
                }
            });
            return true;
        } else {
            return false;
        }

    })

    function isName(event) {
        var regex = new RegExp("^[a-zA-Z \s]+$");
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
            event.preventDefault();
            return false;
        }
    }
</script>
<script>
    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode >
            31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }
</script>
@endsection