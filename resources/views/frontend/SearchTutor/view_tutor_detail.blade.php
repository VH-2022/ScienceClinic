@extends('layouts.frontend')
@section('content')
@section('page-css')
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.min.css">
<link href="{{ asset('assets/css/toastr.css') }}" rel="stylesheet" />
@endsection

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
                                                <div class="row">

                                                    <input type="hidden" name="tutorid" value="{{$data->id}}">
                                                    <div class="col-md-6 col-lg-6">
                                                        <label class="tutor-label">First Name</label>
                                                        <input type="text " class="mb-0" id="first_name" name="first_name" placeholder="First Name ">
                                                        <span class="text-danger" id="error_first_name"></span>

                                                    </div>
                                                    <div class="col-md-6 col-lg-6">
                                                        <label class="tutor-label">Last Name</label>
                                                        <input type="text" class="mb-0" id="last_name" name="last_name" placeholder="Last Name ">
                                                        <span class="text-danger" id="error_last_name"></span>

                                                    </div>
                                                    <div class="col-md-6 col-lg-6 ">
                                                        <label class="tutor-label">Email</label>
                                                        <input type="text" class="mb-0" id="email" name="email" placeholder="Email ">
                                                        <span class="text-danger" id="error_email"></span>

                                                    </div>
                                                    <!-- <div class="col-md-4">
                                                        <label class="tutor-label">Password</label>
                                                        <input type="password" name="password" placeholder="Password">
                                                    </div> -->
                                                    <div class="col-md-6 col-lg-6">
                                                        <label class="tutor-label">Phone</label>
                                                        <input type="text " class="mb-0 numberCls" id="phone" name="phone" placeholder="Phone " maxlength="12">
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
                                                            <option value="8:00-9:00">
                                                                8am- 9am
                                                            </option>
                                                            <option value="9:00-10:00">
                                                                9am - 10am
                                                            </option>
                                                            <option value="10:00-11:00">
                                                                10am - 11am
                                                            </option>
                                                        </select>
                                                        <span class="text-danger" id="error_time"></span>

                                                    </div>


                                                    <div class="col-md-12">
                                                        <label class="tutor-label">Address</label>
                                                        <textarea name="address" cols="20" rows="10" id="address" placeholder="Address" class="mb-0"></textarea>
                                                        <span class="text-danger" id="error_address"></span>

                                                    </div>

                                                    <div class="col-md-6 col-lg-6">
                                                        <label class="tutor-label">Username</label>
                                                        <input type="text" class="mb-0" name="username" id="username" placeholder="Username ">
                                                        <span class="text-danger" id="error_username"></span>

                                                    </div>

                                                    <div class="col-md-6 col-lg-6">
                                                        <label class="tutor-label">Password</label>
                                                        <input type="password" id="password" class="mb-0" name="password" placeholder="Password">
                                                        <span class="text-danger" id="error_password"></span>

                                                    </div>

                                                    <div class="col-md-6 col-lg-4">
                                                        <div class="form-check custom-check">
                                                            <input class="form-check-input terms-condition" type="checkbox" value="" id="defaultCheck1">
                                                            <label class="form-check-label condition-text" for="defaultCheck1">
                                                                <a class="condition-text" href="#">Terms & conditions </a>
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
                                            <div class="col-lg-12 col-md-12 col-12">
                                                <div class="comments comments-overflow-show" id="down">
                                                    <div class="section-title-wrapper section-title-wrapper-star">
                                                        <div class="section-title">
                                                            <h3 class="mb-4">Reviews and References</h3>
                                                        </div>


                                                    </div>

                                                    <div class="mb-3 mt-3">
                                                        <label for="comment">Description</label>
                                                        <textarea class="form-control mb-0" rows="5" id="description" name="description"></textarea>
                                                        <span class="text-danger" id="error_description"></span>
                                                    </div>
                                                    <form action="">
                                                        <div class="row">
                                                            <div class="col-6">

                                                                <div class="from-group">
                                                                    <label for="subject">Subject:</label>
                                                                    <input type="text" class="form-control mb-0" maxlength="30" id="subject" placeholder="" name="subject">
                                                                </div>
                                                                <span class="text-danger" id="error_subject"></span>
                                                            </div>

                                                            <div class="col-6">
                                                                <div class="from-group">
                                                                    <label for="outcome">Outcome:</label>
                                                                    <input type="text" class="form-control mb-0" maxlength="30" id="outcome" placeholder="" name="outcome">
                                                                </div>
                                                                <span class="text-danger" id="error_outcome"></span>
                                                            </div>
                                                            <div class="col-6 mt-4">
                                                                <div class="stars-review">
                                                                    <div>
                                                                        <fieldset class="rate">
                                                                            <input type="radio" id="rating10" name="rating" value="5" class="mb-0" /><label for="rating10" title="5 stars"></label>
                                                                            <input type="radio" id="rating9" name="rating" value="4.5" /><label class="half" for="rating9" title="4.5 stars"></label>
                                                                            <input type="radio" id="rating8" name="rating" value="4" /><label for="rating8" title="4 stars"></label>
                                                                            <input type="radio" id="rating7" name="rating" value="3.5" /><label class="half" for="rating7" title="3.5 stars"></label>
                                                                            <input type="radio" id="rating6" name="rating" value="3" /><label for="rating6" title="3 stars"></label>
                                                                            <input type="radio" id="rating5" name="rating" value="2.5" /><label class="half" for="rating5" title="2.5 stars"></label>
                                                                            <input type="radio" id="rating4" name="rating" value="2" /><label for="rating4" title="2 stars"></label>
                                                                            <input type="radio" id="rating3" name="rating" value="1.5" /><label class="half" for="rating3" title="1.5 stars"></label>
                                                                            <input type="radio" id="rating2" name="rating" value="1" /><label for="rating2" title="1 star"></label>
                                                                            <input type="radio" id="rating1" name="rating" value="0.5" /><label class="half" for="rating1" title="0.5 star"></label>

                                                                        </fieldset>
                                                                    </div>
                                                                    <span class="text-danger" id="error_rating"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="tutor-btn-end mr-0">
                                                                    <div class="banner-readmore">
                                                                        <a class="button-default inline" onclick="submitreview('{{$data->id}}')" href="javascript:void(0)">submit</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                </div>

                                                </form>


                                            </div>
                                        </div>
                                        <div class="comments">
                                            <h4 class="title">Comments</h4>
                                            <div class="single-comment" id="reviewcomment">

                                            </div>

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

<div class="testimonial-section">
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
                                                We would like to pass on our feedback and show appreciation for Mr
                                                Hamalabi from Science Clinic Private Tutoring Ltd who worked with
                                                our daughter and improved her Chemistry & Physics skills in the run
                                                up to her GCSE exams He was only with us for a short
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
                                                Thank you Science Clinic Private Tutoring Ltd for your prompt and
                                                efficient service. It was so simple, I wish we had found you sooner.

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
                                                Can't believe how quickly this has worked. I went on the Internet on
                                                15th January and Chloe had a lesson today with Mr Hamalabi who is
                                                only 5 minutes drive away from us. We are so pleased and delighted.

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
                                                I would like you to know how delighted we have been with Mr Hamalabi
                                                who has provided home tuitions in Physics, Mathematics & Chemistry
                                                to my daughter for 3 years. She went from C grade at the end of year
                                                9 to getting A*, A & A respectively in her GCSE.

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
                                                We are grateful to Mr Hamalabi from Science Clinic Private Tutoring
                                                Ltd for giving Tom confidence and for assisting him greatly in
                                                improving his performance to the level of getting A & A* in Biology,
                                                Chemistry & Physics.

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
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.min.js"></script>
<script src="{{ asset('assets/js/toastr.min.js') }}"></script>

<script>
    function ValidateEmail(email) {

        var expr =
            /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        return expr.test(email);
    }

    function submitreview(id) {
        var description = $('#description').val();
        var subject = $('#subject').val();
        var outcome = $('#outcome').val();
        var temp = 0;
        var rating = $("input[name='rating']:checked").val();
        $('#error_description').html('');
        $('#error_subject').html('');
        $('#error_outcome').html('');
        $('#error_rating').html('');


        if (description.trim() == '') {
            $('#error_description').html('Description is required');
            temp++;
        }
        if (subject.trim() == '') {
            $('#error_subject').html('Subject is required');
            temp++;
        }
        if (outcome.trim() == '') {
            $('#error_outcome').html('Outcome is required');
            temp++;
        }
        if ($('input[name="rating"]:checked').length == 0) {
            $('#error_rating').html('Rating is required');
            temp++;
        }

        if (temp == 0) {
            $.ajax({
                url: "{{ route('submit.review')}}",
                data: {
                    'id': id,
                    'description': description,
                    'subject': subject,
                    'outcome': outcome,
                    'rating': rating
                },
                success: function(res) {
                    console.log(res.data);
                    var review = '<div class=single-comment><div class=comment-text><div class=author-info><h4><a href=#>MD Tokdir Ali</a></h4><span class=reply><div class=review-score><div class="stars stars2"aria-label="Rating of this product is 2.3 out of 5."style=--rating:' + res.data.rating + '></div></div></span></div><p>' + res.data.descriptions + '<div class=author-subject><div class=subject-divs><p class=subject-details>Subject :<p class=subject-name>' + res.data.subject + '</div><div class=subject-divs><p class=subject-details>Outcome :<p class=subject-name>' + res.data.outcome + '</div></div></div></div>';
                    $('#reviewcomment').html("");
                    $('#reviewcomment').html(review);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    var tempVal = 0;
                    if (jqXHR.responseJSON.message.description) {
                        tempVal++;
                        $('#error_description').text(jqXHR.responseJSON.message.description);
                    } else {
                        $('#error_description').text('');
                    }
                    if (jqXHR.responseJSON.message.subject) {
                        tempVal++;
                        $('#error_subject').text(jqXHR.responseJSON.message.subject);
                    } else {
                        $('#error_subject').text('');
                    }
                    if (jqXHR.responseJSON.message.outcome) {
                        tempVal++;
                        $('#error_outcome').text(jqXHR.responseJSON.message.outcome);
                    } else {
                        $('#error_outcome').text('');
                    }
                    if (jqXHR.responseJSON.message.rating) {
                        tempVal++;
                        $('#error_rating').text(jqXHR.responseJSON.message.rating);
                    } else {
                        $('#error_rating').text('');
                    }
                    if (tempVal == 0) {
                        return true;
                    } else {
                        return false;
                    }
                }
            })

        } else {
            return false;
        }

    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: 'prev,next',
                center: 'title',
                right: ''
            },
            contentHeight: "auto",
            allDaySlot: false,
            editable: true,
            initialView: 'timeGridWeek',
            slotDuration: '01:00',
            displayEventTime: false,
            events: [

                {
                    title: 'Booked',
                    start: '2022-03-27T24:00:00',
                    classNames: 'event-book-label',
                },
                {
                    title: 'Booked',
                    start: '2022-03-28T24:00:00',
                    classNames: 'event-book-label',
                },
                {
                    title: 'Booked',
                    start: '2022-03-29T24:00:00',
                    classNames: 'event-book-label',
                },
                {
                    title: 'Booked',
                    start: '2022-03-30T24:00:00',
                    classNames: 'event-book-label',
                },
                {
                    title: 'Booked',
                    start: '2022-03-30T02:00:00',
                    classNames: 'event-book-label',
                },
                {
                    title: 'No availability',
                    start: '2022-03-29T01:00:00',
                    classNames: 'event-no-book-label',
                },
                {
                    title: 'No availability',
                    start: '2022-03-29T02:00:00',
                    classNames: 'event-no-book-label',
                },
                {
                    title: 'No availability',
                    start: '2022-03-31T03:00:00',
                    classNames: 'event-no-book-label',
                },
                {
                    title: 'No availability',
                    start: '2022-04-01T03:00:00',
                    classNames: 'event-no-book-label',
                }

            ],
            editable: false,
            selectable: false
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
                    console.log(res.data);
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