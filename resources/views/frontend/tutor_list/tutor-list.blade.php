@extends('layouts.frontend')

@section('content')

<div class="as-mainwrapper">
    <!--Bg White Start-->
    <div class="bg-white">
        <!--Header Area Start-->
        <div id="header"></div>
        <!--End of Header Area-->
        <!--background Area Start-->
        <div class="backgrount-area  bg-bilology full-grayoverlay">
            <div class="banner-content padding-headsection">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="text-content-wrapper text-center full-width">
                                <div class="text-content text-center-content">
                                    <h1 class="title1 text-center max-englishtext mb-20">
                                        <span class="tlt block" data-in-effect="fadeInRight" data-out-effect="fadeOutRight">Expert online learning and tuition to fit around you</span>
                                    </h1>

                                    <p>
                                        Our tutors cover a wide variety of subjects including English, Maths,
                                        Biology, Chemistry and Physics allowing you to find the perfect tuition to
                                        help you achieve the results you are looking for. Learning online means that
                                        you don’t have to travel and
                                        you can study in the comfort of your own, in your own time and at a pace
                                        that suits you.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--End of background Area-->
        <section class="">
            <!--About Area Start-->
            <div class="english-abc tutors-padding res-pt-50">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-lg-9">
                            <div class="row">
                                @foreach($tutorData as $val)
                          
                                    <div class="col-md-6 col-lg-4 tutor-card">
                                        
                                        <a class="tutor-content" href="{{route('tutors-details',sha1($val->id))}}">
                                            <div class="single-product-item">
                                                <div class="single-product-image">
                                                    <img src="{{$val->profile_photo}}">
                                                </div>
                                                <div class="single-product-text">
                                                    <h4 class="testing-user"> {{$val->first_name}}</h4>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                        <div class="col-md-12 col-lg-3 position-side">
                            <div class="p-tags">
                                <div class="side-subject">
                                    <div class="subject-details">
                                        <h3 class="compares-papers">Subject
                                        </h3>
                                        @foreach($allSubjectsData as $subject)
                                        <div class="max-hgt-subject">
                                            <ul class="subject-uls">
                                                <li class="position-relative">
                                                    <div class="custom-checkbox-subject">
                                                        <div class="custom-control custom-radio">
                                                            <input type="checkbox" id="customRadio1" name="customRadio" class="custom-control-input">

                                                            <label class="custom-control-label" for="customRadio1">{{$subject->main_title}} </label>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="side-subject">
                                    <div class="subject-details res-pt-30">
                                        <h3 class="compares-papers">Education Level
                                        </h3>
                                        @foreach($allLevelData as $level)
                                        <div class="max-hgt-subject">
                                            <ul class="subject-uls">
                                                <li class="position-relative">
                                                    <div class="custom-checkbox-subject">
                                                        <div class="custom-control custom-radio">
                                                            <input type="checkbox" id="level1" name="level" class="custom-control-input">

                                                            <label class="custom-control-label" for="level1">{{$level->title}}</label>

                                                            
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        @endforeach
                                    </div>
                                    <div class="banner-readmore mt-4">
                                        <a class="button-default inline" href="javascript:void(0)">Filter</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--End of About Area-->
            <!-- English Testimonials area Start-->
            @include('frontend.testimonial.testmonial')
            <!-- English Testimonials area End-->
        </section>



        <div id="footer"></div>
    </div>
    <!--End of Bg White-->
</div>


@endsection
@section('page-js')
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
@endsection