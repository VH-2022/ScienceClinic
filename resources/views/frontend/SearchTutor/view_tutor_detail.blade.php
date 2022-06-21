@extends('layouts.frontend')
@section('content')
@section('page-css')

<link rel="stylesheet" href="{{asset('front/css/jquery-ui.css')}}">

<link rel="stylesheet" href="{{asset('assets/css/fullcalender-css/main.min.css')}}">
<link href="{{ asset('assets/css/toastr.css') }}" rel="stylesheet" />
<style>
    .form-data .col-md-6,
    .form-data .col-md-12 {
        margin-bottom: 23px;
    }
</style>
@endsection
<style>
    .fc-event-main {
        float: middle;
        text-align: center;
    }
</style>
<div class="as-mainwrapper">
    <!--Bg White Start-->
    <div class="bg-white">
        <!--Header Area Start-->
        <div id="header"></div>
        <!--End of Header Area-->
        <section class="tutors-details">
            <div class="course-details-area section-padding tutor-padding">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-9 col-md-12 col-12">
                            <div class="course-details-content">
                                <div class="single-course-details mb-3">
                                    <div class="row align-items-center">
                                        <div class="col-md-5">
                                            <div class="overlay-effect">
                                                <img alt="" src="{{$data->profile_photo}}" class="tutors-detailimg">
                                            </div>
                                        </div>
                                        <div class="col-md-7" style="padding-left: 0px;">
                                            <div class="single-item-text">

                                                <h4>{{$data->first_name}} – Science</h4>
                                                <div class="course-text-content tutors-content">
                                                    <p>Fully Qualified Science Teacher (all 3 Sciences) with QTS</p>

                                                </div>

                                                <input type="hidden" id="tutorid" value="{{$data->id}}">
                                                <div class="single-item-content  pt-3">
                                                    <div class="title-education">
                                                        <h5>EDUCATION</h5>
                                                    </div>

                                                    <div class="title-eductiondetails">
                                                        @foreach($tutorUniversityDetails as $value)
                                                        <p><span style="font-weight:600;">{{$value->university_name}}: </span>{{$value->qualification}}
                                                        </p>
                                                        @endforeach
                                                    </div>

                                                </div>
                                                <div class="button-total">

                                                    <a class="button-default inline" href="#down">Enquire About
                                                        {{$data->first_name}} – Science</a>
                                                </div>

                                                <div class="dbs-check dbs-checked-box">
                                                    @if($tutorDetails->dbs_disclosure == "Yes")
                                                    <h5 class=" dbs mr-2">DBS checked</h5>
                                                    @endif


                                                </div>
                                                <div class="">
                                                    <h5 class=" dbs mr-2">Qualifications on file</h5>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="bio-text">
                                    <div class="single-item-content pt-0 pb-2">

                                        <div class="title-eductiondetails">
                                            <div class="title-education">
                                                <h5>BIO</h5>
                                            </div>
                                            <div class="pt-3">
                                                <p>{{$data->bio}}.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="title-education mb-3">
                                    <h5>Availability Calendar</h5>
                                </div>
                                <div class="main-custom-calendar">
                                    <div id='calendar'></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-12 col-12 ">
                            <div class="p-tags ">
                                <div class="side-subject mb-5 ">
                                    <div class="subject-details ">
                                        <div class="title-education mb-3 ">
                                            <h5>SUBJECTS</h5>
                                        </div>
                                        <div class="education-subject">

                                            @foreach($tutorSubjectLevelDetails as $value)

                                            <ul class="subject-tutor-ul ">
                                                <p style="font-weight: 600; ">{{$value->main_title}}</p>


                                                @foreach($value->level_details as $level)
                                                <li><img src="{{asset('front/img/svg/right-arrow.png')}} " class="list-arrows">{{$level->title}}
                                                </li>
                                                @endforeach


                                            </ul>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>



                                <div class="main-custom-calendar">
                                    <div id='calendar'></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-12">
                            <div class="comments comments-overflow-show" id="down">
                                <div class="section-title-wrapper">
                                    <div class="section-title">
                                        <h3 class="mb-4">Tutor Enquiry</h3>
                                    </div>

                                </div>
                                <div class="contact-form-area tutors-detail-form">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-10 col-md-12 col-12">
                                            <form id="submitinquiry" method="POST">
                                                @csrf
                                                <div class="row form-data">

                                                    <input type="hidden" name="tutorid" value="{{$data->id}}">
                                                    <div class="col-md-6 col-lg-6">
                                                        <label class="tutor-label">First Name</label>
                                                        <input autocomplete="off" type="text" class="mb-0" id="first_name" name="first_name" placeholder="First Name ">
                                                        <span class="text-danger" id="error_first_name"></span>

                                                    </div>
                                                    <div class="col-md-6 col-lg-6">
                                                        <label class="tutor-label">Last Name</label>
                                                        <input autocomplete="off" type="text" class="mb-0" id="last_name" name="last_name" placeholder="Last Name ">
                                                        <span class="text-danger" id="error_last_name"></span>

                                                    </div>
                                                    <div class="col-md-6 col-lg-6 ">
                                                        <label class="tutor-label">Email</label>
                                                        <input autocomplete="off" type="text" class="mb-0" id="email" name="email" placeholder="Email">
                                                        <span class="text-danger" id="error_email"></span>

                                                    </div>
                                                    <!-- <div class="col-md-4">
                                                        <label class="tutor-label">Password</label>
                                                        <input type="password" name="password" placeholder="Password">
                                                    </div> -->
                                                    <div class="col-md-6 col-lg-6">
                                                        <label class="tutor-label">Phone</label>
                                                        <input autocomplete="off" type="text" class="mb-0 numberCls" id="phone" name="phone" placeholder="Phone " maxlength="12">
                                                        <span class="text-danger" id="error_phone"></span>

                                                    </div>
                                                    @php $daysArr = [ 'Monday' =>'monday',
                                                    'Tuesday' => 'tuesday',
                                                    'Wednesday' => 'wednesday',
                                                    'Thursday' => 'thursday',
                                                    'Friday' => 'friday',
                                                    'Saturday' => 'saturday',
                                                    'Sunday' => 'sunday'] @endphp



                                                    <div class="col-md-6 col-lg-6">
                                                        <label class="tutor-label">Subject</label>
                                                        <select name="subjectinquiry" id="subjectinquiry" class="mb-0">
                                                            <option value="">Select Subject</option>
                                                            @foreach($subject_list as $subject)
                                                            <option value="{{$subject->id}}">{{$subject->main_title}}</option>
                                                            @endforeach


                                                        </select>
                                                        <span class="text-danger" id="error_subjectinquiry"></span>

                                                    </div>

                                                    <div class="col-md-6 col-lg-6">
                                                        <label class="tutor-label">Level of Tuition</label>
                                                        <select name="level" id="level" class="mb-0">
                                                            <option value="">Select Level</option>
                                                            @foreach($tutor_level_list as $level)
                                                            <option value="{{$level->id}}">{{$level->title}}
                                                            </option>
                                                            @endforeach

                                                        </select>
                                                        <span class="text-danger" id="error_level"></span>

                                                    </div>
                                                    <div class="col-md-6 col-lg-6">
                                                        <label class="tutor-label">Day of Tuition</label>
                                                        <select name="days" class="mb-0" id="days">
                                                            <option value="">Select Days</option>
                                                            @foreach($daysArr as $key=>$val)
                                                            <option value="{{$val}}">
                                                                {{$key}}
                                                            </option>
                                                            @endforeach

                                                        </select>
                                                        <span class="text-danger" id="error_days"></span>

                                                    </div>
                                                    <div class="col-md-6 col-lg-6">
                                                        <label class="tutor-label">Ideal Tuition Time</label>
                                                        <select id="time" class="mb-0" name="tuition_time">
                                                            <option value="">Select Time</option>
                                                            <option value="08:00:00-09:00:00">
                                                                8am- 9am
                                                            </option>
                                                            <option value="09:00:00-10:00:00">
                                                                9am - 10am
                                                            </option>
                                                            <option value="10:00:00-11:00:00">
                                                                10am - 11am
                                                            </option>
                                                        </select>
                                                        <span class="text-danger" id="error_time"></span>

                                                    </div>


                                                    <div class="col-md-12">
                                                        <label class="tutor-label">Address</label>
                                                        <textarea autocomplete="off" name="address" cols="20" rows="10" id="address" placeholder="Address" class="mb-0"></textarea>
                                                        <span class="text-danger" id="error_address"></span>

                                                    </div>

                                                    <div class="col-md-6 col-lg-6">
                                                        <label class="tutor-label">Username</label>
                                                        <input autocomplete="off" type="text" class="mb-0" name="username" id="username" placeholder="Username ">
                                                        <span class="text-danger" id="error_username"></span>

                                                    </div>

                                                    <div class="col-md-6 col-lg-6" id="passwordHide">
                                                        <label class="tutor-label">Password</label>
                                                        <input type="password" id="password" class="mb-0" name="password" placeholder="Password">
                                                        <span class="text-danger" id="error_password"></span>

                                                    </div>

                                                    <div class="col-md-6 col-lg-4">
                                                        <div class="form-check custom-check">
                                                            <input class="form-check-input terms-condition" type="checkbox" value="" id="defaultCheck1">
                                                            <label class="form-check-label condition-text" for="defaultCheck1">
                                                                <a class="condition-text" href="terms-and-conditions.html">Terms & conditions </a>
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 mr-0">
                                                        <div class="tutor-btn-end mr-0">
                                                            <div class="banner-readmore">

                                                                <a class="button-default inline" href="javascript:void(0)" onclick="saveinquiry();">submit</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </form>

                                        </div>
                                        <div class="comments">
                                            <h4 class="title">Comments</h4>
                                            @if(count($tutor_comments)>0)
                                            @foreach($tutor_comments as $value)
                                            <div class="single-comment" id="reviewcomment">
                                                <div class="comment-text">
                                                    <div class="author-info">
                                                        <h4><a href="#">{{$value->userDetails->first_name}} {{$value->userDetails->last_name}}</a></h4>
                                                        <span class="reply">
                                                            <div class="review-score">
                                                                <div class="stars stars2" style="--rating: {{$value->rating}};" aria-label="Rating of this product is 2.3 out of 5."></div>
                                                            </div>
                                                        </span>
                                                    </div>
                                                    <p>{{$value->descriptions}}</p>
                                                    <div class="author-subject">
                                                        <div class="subject-divs">
                                                            <p class="subject-details">Subject : </p>
                                                            <p class="subject-name">{{$value->subjectDetails->main_title}}</p>
                                                        </div>
                                                        <div class="subject-divs">
                                                            <p class="subject-details">Outcome :</p>
                                                            <p class="subject-name">{{$value->outcome}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                            @else
                                            <h6>No Comments Available</h6>
                                            @endif
                                        </div>
                                    </div>



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
</div>

</div>
</section>

@include('frontend.testimonial.testmonial')

<div class="ec-colorswitcher ">
    <a class="ec-handle " href="# "><i class="zmdi zmdi-settings "></i></a>
    <h3>Style Switcher</h3>
    <div class="ec-switcherarea ">
        <h6>Select Layout</h6>
        <div class="layout-btn ">
            <a href="# " class="ec-boxed "><span>Boxed</span></a>
            <a href="# " class="ec-wide "><span>Wide</span></a>
        </div>
        <h6>Chose Color</h6>
        <ul class="ec-switcher ">
            <li>
                <a href="# " class="cs-color-1 styleswitch " data-rel="color-one "></a>
            </li>
            <li>
                <a href="# " class="cs-color-2 styleswitch " data-rel="color-two "></a>
            </li>
            <li>
                <a href="# " class="cs-color-3 styleswitch " data-rel="color-three "></a>
            </li>
            <li>
                <a href="# " class="cs-color-4 styleswitch " data-rel="color-four "></a>
            </li>
            <li>
                <a href="# " class="cs-color-5 styleswitch " data-rel="color-five "></a>
            </li>
            <li>
                <a href="# " class="cs-color-6 styleswitch " data-rel="color-six "></a>
            </li>
            <li>
                <a href="# " class="cs-color-7 styleswitch " data-rel="color-seven "></a>
            </li>
            <li>
                <a href="# " class="cs-color-8 styleswitch " data-rel="color-eight "></a>
            </li>
            <li>
                <a href="# " class="cs-color-9 styleswitch " data-rel="color-nine "></a>
            </li>
            <li>
                <a href="# " class="cs-color-10 styleswitch " data-rel="color-ten "></a>
            </li>
        </ul>
        <div class="ec-pattren ">
            <h6>Chose Pattren</h6>
            <div class="pattren-wrap ">
                <a href="# " data-rel="pattren1 " class="styleswitch "><img src="{{asset('front/img/ec-pattren/pattren1.jpg')}} " alt=" "></a>
                <a href="# " data-rel="pattren2 " class="styleswitch "><img src="{{asset('front/img/ec-pattren/pattren2.jpg')}} " alt=" "></a>
                <a href="# " data-rel="pattren3 " class="styleswitch "><img src="{{asset('front/img/ec-pattren/pattren3.jpg')}} " alt=" "></a>
                <a href="# " data-rel="pattren4 " class="styleswitch "><img src="{{asset('front/img/ec-pattren/pattren4.jpg ')}}" alt=" "></a>
                <a href="# " data-rel="pattren5 " class="styleswitch "><img src="{{asset('front/img/ec-pattren/pattren5.jpg')}} " alt=" "></a>
            </div>
        </div>
        <div class="ec-background ">
            <h6>Chose Background</h6>
            <div class="background-wrap ">
                <a href="# " data-rel="background1 " class="styleswitch "><img src="{{asset('front/img/ec-background/bg-1.jpg ')}}" alt=" "></a>
                <a href="# " data-rel="background2 " class="styleswitch "><img src="{{asset('front/img/ec-background/bg-2.jpg')}} " alt=" "></a>
                <a href="# " data-rel="background3 " class="styleswitch "><img src="{{asset('front/img/ec-background/bg-3.jpg')}} " alt=" "></a>
                <a href="# " data-rel="background4 " class="styleswitch "><img src="{{asset('front/img/ec-background/bg-4.jpg')}} " alt=" "></a>
                <a href="# " data-rel="background5 " class="styleswitch "><img src="{{asset('front/img/ec-background/bg-5.jpg ')}}" alt=" "></a>
            </div>
        </div>
    </div>
</div>
@endsection


@section('page-js')
<script src="{{asset('front/js/bootstrap-select.min.js')}}"></script>
<script src="{{asset('front/js/vendor/jquery-1.12.4.min.js')}}"></script>

<script src="{{asset('assets/js/fullcalender-js/main.min.js')}}"></script>

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
    function ValidateEmail(email) {

        var expr =
            /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        return expr.test(email);
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var tutorId = $('#tutorid').val();
        var calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: 'prev,next',
                center: 'title',
                right: ''
            },
            contentHeight: "auto",


            initialView: 'timeGridWeek',
            slotDuration: '01:00',
            displayEventTime: false,
            allDaySlot: false,
            html: true,

            eventContent: {
                html: '<a><i class="fa fa-check"></i></a>'
            },
            events: function(fetchInfo, callback) {

                var events = [];
                $.ajax({
                    url: "{{route('tutor-availability-get')}}",
                    type: 'get',
                    data: {
                        tutotid: tutorId
                    },
                    success: function(result) {

                        if (!!result) {
                            $.map(result, function(r) {

                                events.push({
                                    start: r.available_datetime,
                                    title: 'Available',
                                    "textColor": "#ffffff"



                                })

                            });
                        }
                        callback(events);
                    }
                })


            },
        });

        calendar.render();
    });
    //-----------------------

    $('.testimonial-english').owlCarousel({
        loop: true,
        margin: 10,
        nav: true,
        navText: ["<img src='{{asset('front/img/svg/left-arrow-test.png')}}'>", "<img src='{{asset('front//img/svg/right-arrow-test.png')}}'>"],
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

    function ValidatePassword(password) {
        var expr = /^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!@$#%&*]).{6,}$/;
        return expr.test(password);
    }

    function saveinquiry() {
        var firstName = $('#first_name').val();
        var lastName = $('#last_name').val();
        var email = $('#email').val();
        var phone = $('#phone').val();
        var address = $('#address').val();
        var username = $('#username').val();
        var password = $('#password').val();
        var subject = $("select[name='subjectinquiry']").val();
        var level = $("select[name='level']").val();
        var days = $("select[name='days']").val();
        var tuitionTime = $("select[name='tuition_time']").val();
        var temp = 0;

        $('#error_first_name').html('');
        $('#error_last_name').html('');
        $('#error_email').html('');
        $('#error_phone').html('');
        $('#error_address').html('');
        $('#error_username').html('');
        $('#error_password').html('');
        $('#error_subjectinquiry').html('');
        $('#error_level').html('');
        $('#error_days').html('');
        $('#error_time').html('');


        if (firstName.trim() == '') {
            $('#error_first_name').html('Firstname is required');
            temp++;
        }
        if (lastName.trim() == '') {
            $('#error_last_name').html('Lastname is required');
            temp++;
        }
        if (email.trim() == '') {
            $('#error_email').html('Email is required');
            temp++;
        } else {

            if (!ValidateEmail(email)) {

                $('#error_email').html("Invalid email");

                temp++;

            }

        }
        if (phone.trim() == '') {
            $('#error_phone').html('Phone is required');
            temp++;
        }
        if (address.trim() == '') {
            $('#error_address').html('Address is required');
            temp++;
        }
        if (username == '') {
            $('#error_username').html('Username is required');
            temp++;
        }
        if (password == '') {
            $('#error_password').html('Password is required');
            temp++;
        } else {
            if (!ValidatePassword(password)) {
                $("#error_password").html("Password should include 6 charaters, alphabets, numbers and special characters");
                temp++;
            }
        }
        if (subject.trim() == '') {
            $('#error_subjectinquiry').html('Subject is required');
            temp++;
        }

        if (days.trim() == '') {
            $('#error_days').html('Day is required');
            temp++;
        }

        if (tuitionTime.trim() == '') {
            $('#error_time').html('Time is required');
            temp++;
        }
        if (level.trim() == '') {
            $('#error_level').html('Level is required');
            temp++;
        }
        if (temp == 0) {
            $.ajax({
                url: "{{route('submit.inquiry')}}",
                type: 'post',
                data: new FormData($('#submitinquiry')[0]),
                processData: false,
                contentType: false,
                cache: false,
                success: function(res) {
                    toastr.success(res.error_msg);
                    $('#submitinquiry').trigger("reset");
                },
                error: function(jqXHR, textStatus, errorThrown) {

                    var tempVal = 0;
                    if (jqXHR.responseJSON.message.first_name) {
                        tempVal++;
                        $('#error_first_name').text(jqXHR.responseJSON.message.first_name);
                    } else {
                        $('#error_first_name').text('');
                    }
                    if (jqXHR.responseJSON.message.last_name) {
                        tempVal++;
                        $('#error_last_name').text(jqXHR.responseJSON.message.last_name);
                    } else {
                        $('#error_last_name').text('');
                    }
                    if (jqXHR.responseJSON.message.email) {
                        tempVal++;
                        $('#error_email').text(jqXHR.responseJSON.message.email);
                    } else {
                        $('#error_email').text('');
                    }
                    if (jqXHR.responseJSON.message.phone) {
                        tempVal++;
                        $('#error_phone').text(jqXHR.responseJSON.message.phone);
                    } else {
                        $('#error_phone').text('');
                    }
                    if (jqXHR.responseJSON.message.address) {
                        tempVal++;
                        $('#error_address').text(jqXHR.responseJSON.message.address);
                    } else {
                        $('#error_address').text('');
                    }
                    if (jqXHR.responseJSON.message.username) {
                        tempVal++;
                        $('#error_username').text(jqXHR.responseJSON.message.username);
                    } else {
                        $('#error_username').text('');
                    }
                    if (jqXHR.responseJSON.message.password) {
                        tempVal++;
                        $('#error_password').text(jqXHR.responseJSON.message.password);
                    } else {
                        $('#error_password').text('');
                    }
                    if (jqXHR.responseJSON.message.subjectinquiry) {
                        tempVal++;
                        $('#error_subjectinquiry').text(jqXHR.responseJSON.message.subjectinquiry);
                    } else {
                        $('#error_subjectinquiry').text('');
                    }
                    if (jqXHR.responseJSON.message.level) {
                        tempVal++;
                        $('#error_level').text(jqXHR.responseJSON.message.level);
                    } else {
                        $('#error_level').text('');
                    }
                    if (jqXHR.responseJSON.message.days) {
                        tempVal++;
                        $('#error_days').text(jqXHR.responseJSON.message.days);
                    } else {
                        $('#error_days').text('');
                    }
                    if (jqXHR.responseJSON.message.tuition_time) {
                        tempVal++;
                        $('#error_time').text(jqXHR.responseJSON.message.tuition_time);
                    } else {
                        $('#error_time').text('');
                    }

                    if (tempVal == 0) {
                        return true;
                    } else {
                        return false;
                    }
                }
            })
            return true;
        } else {
            return false;
        }

    }
</script>
<script>
    $('.numberCls').keypress(function(event) {
        if (event.keyCode < 48 || event.keyCode > 57) {
            event.preventDefault();
        }
    });
    $(function() {
        $("#datepicker").datepicker();
    });

    var timeout = null;

    $('#email').keyup(function() {
        clearTimeout(timeout);

        timeout = setTimeout(function() {
            var email = $("#email").val();
            if (email != '') {
                $.ajax({
                    type: 'POST', //THIS NEEDS TO BE GET
                    url: '{{route("check-email-parent")}}',
                    data: {
                        email: email,
                        _token: '{{csrf_token()}}'
                    },
                    success: function(response) {
                        if (response == '1') {
                            $("#passwordHide").css('display', 'none');
                        } else {
                            $("#passwordHide").css('display', 'block');
                        }
                    },
                    error: function() {

                    }
                });
            }
        }, 500);
    });
</script>

<script>
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "3000",
        "extendedTimeOut": 0,
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut",
        "tapToDismiss": false
    };
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