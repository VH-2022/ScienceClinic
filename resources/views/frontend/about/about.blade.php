@extends('layouts.frontend')
@section('content')
    <!--Main Wrapper Start-->
    <div class="as-mainwrapper">
        <!--Bg White Start-->
        <div class="bg-white">
            <!--Header Area Start-->
            <div id="header"></div>
            <!--End of Header Area-->
            <!--Background Area Start-->


            <!-- <div class="backgrount-area bg-chemistry  full-grayoverlay" style="background-image: linear-gradient(45deg, rgb(45 62 80 / 60%),rgb(45 62 80 / 60%)),url(./img/svg/science-clinic-private-tutors-about-us.png);"> -->
            <div class="banner-content padding-headsection-small">
                    <!-- <div class="container">  -->
                        <div>
                            <div>
                                <div class="position-relative">
                                    <div>
                                        <div class="text-content-wrapper full-width about-small-text position-absolute">
                                            <div class="text-content text-center">
                                                <h1 class="title1 text-center mb-20 ml-0">
                                                    <span class="tlt block" data-in-effect="rollIn" data-out-effect="fadeOutRight">Helping your child fulfil</span>
                                                    <span class="tlt block" data-in-effect="fadeInLeftBig" data-out-effect="fadeOutRight"> their potential</span>
                                                </h1>
                                                <div class="banner-readmore custom-bannerread wow bounceInUp" data-wow-duration="2500ms" data-wow-delay=".1s">
                                                    <a class="button-default" href="contact.html">CONTACT US</a>
                                                </div>
                                            </div>
                                        </div>  
                                    </div>
                                    <!-- <div class="backgrount-area bg-chemistry  full-grayoverlay" style="background-image: linear-gradient(45deg, rgb(45 62 80 / 60%),rgb(45 62 80 / 60%)),url(./img/svg/science-clinic-private-tutors-about-us.png);">

                                    </div> -->
                                    <div class="about-small-img" style="background-image: linear-gradient(45deg, rgb(45 62 80 / 60%),rgb(45 62 80 / 60%)),url(./img/svg/science-clinic-private-tutors-about-us.png);">
                                        
                                    </div>
                                </div>
                                <!-- <div class="text-content-wrapper full-width">
                                    <div class="text-content text-center">
                                        <h1 class="title1 text-center mb-20">
                                            <span class="tlt block" data-in-effect="rollIn" data-out-effect="fadeOutRight">Helping your child fulfil</span>
                                            <span class="tlt block" data-in-effect="fadeInLeftBig" data-out-effect="fadeOutRight"> their potential</span>
                                        </h1>
                                        <div class="banner-readmore custom-bannerread wow bounceInUp" data-wow-duration="2500ms" data-wow-delay=".1s">
                                            <a class="button-default" href="contact.html">CONTACT US</a>
                                        </div>
                                    </div>
                                </div> -->
                            </div> 
                        </div>
                    <!-- </div> -->
                </div>
            <!-- </div> -->








            <!-- <div class="">
    <div>
        <div class="col-md-12">
            <div class="text-content-wrapper full-width">
                <div class="text-content text-center">
                    <h1 class="title1 text-center mb-20">
                        <span class="tlt block" data-in-effect="rollIn" data-out-effect="fadeOutRight">Helping your child fulfil</span>
                        <span class="tlt block" data-in-effect="fadeInLeftBig" data-out-effect="fadeOutRight"> their potential</span>
                    </h1>
                    <div class="banner-readmore custom-bannerread wow bounceInUp" data-wow-duration="2500ms" data-wow-delay=".1s">
                        <a class="button-default" href="contact.html">CONTACT US</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
        <div class="backgrount-area bg-chemistry  full-grayoverlay" style="background-image: linear-gradient(45deg, rgb(45 62 80 / 60%),rgb(45 62 80 / 60%)),url(./img/svg/science-clinic-private-tutors-about-us.png);">
    </div>
    </div>

    </div> -->






            <!-- <div class="background-area no-animation">
                <div class="position-relative">
                    <img src="img/svg/science-clinic-private-tutors-about-us.png" alt="" />
                    <div class="over-background">
                        <div class="overs"></div>
                    </div>
                </div>
                <div class="banner-content static-text">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="text-content-wrapper full-width">
                                    <div class="text-content text-center">
                                        <h1 class="title1 text-center mb-20">
                                            <span class="tlt block" data-in-effect="rollIn" data-out-effect="fadeOutRight">Helping your child fulfil</span>
                                            <span class="tlt block" data-in-effect="fadeInLeftBig" data-out-effect="fadeOutRight"> their potential</span>
                                        </h1>
                                        <div class="banner-readmore wow bounceInUp" data-wow-duration="2500ms" data-wow-delay=".1s">
                                            <a class="button-default" href="contact.html">CONTACT US</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <!--End of Background Area-->

            <!--About Area Start-->
            @foreach ($about as $val)
                <div class="welcome-about-area">
                    <div class="container">


                        <div class="row">
                            <div class="col-lg-12">
                                <div class="welcome-about-text about-detail">
                                    <h4 class="text-center">our Story</h4>
                                    <p>
                                        {{ $val->content1 }}
                                    </p>



                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- <div class="welcome-video about-img">
                    <img src="img/svg/about.jpg" alt="">

                </div> -->
                </div>
                <!--End of About Area-->


                <!--Course Area Start-->
                <div class="gray-bgs about-personalize">
                    <div class="container">
                        <div class="row flex-direct-about">
                            <div class="col-lg-6 col-md-12 res-mb-40">
                                <div>
                                
                                        <img src="{{ $val->image }}">
                              
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 res-mb-40">
                                <div class="qualified-text">
                                    <div class="qualified-details">
                                    {!! $val->content2 !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @endforeach
                <!--End of Course Area-->
                <!-- <div class="area-sciences">
                <div class="container">
                    <div class="single-item-text">
                        <h4 class="mb-3">
                            <div class="single-item-text">
                                <h4 class="mb-3">Science Clinic Private Tutoring Ltd is based in Chelmsford city and covers the following areas:
                                </h4>
                            </div>
                        </h4>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <ul class="biolody-ul pt-2 pb-2">
                                <li><img src="img/svg/right-arrow.png" class="list-down">Chelmsford
                                </li>
                                <li><img src="img/svg/right-arrow.png" class="list-down">Brentwood
                                </li>
                                <li><img src="img/svg/right-arrow.png" class="list-down">Billericay
                                </li>
                                <li><img src="img/svg/right-arrow.png" class="list-down">Witham
                                </li>
                                <li><img src="img/svg/right-arrow.png" class="list-down">South Woodham Ferrers
                                </li>
                                <li><img src="img/svg/right-arrow.png" class="list-down">Ongar
                                </li>
                                <li><img src="img/svg/right-arrow.png" class="list-down">Braintree
                                </li>
                                <li><img src="img/svg/right-arrow.png" class="list-down">Maldon
                                </li>
                                <li><img src="img/svg/right-arrow.png" class="list-down">Great Baddow
                                </li>
                                <li><img src="img/svg/right-arrow.png" class="list-down">South-End
                                </li>
                                <li><img src="img/svg/right-arrow.png" class="list-down">Harlow
                                </li>
                                <li><img src="img/svg/right-arrow.png" class="list-down">Colchester
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <ul class="biolody-ul pt-2 pb-2">
                                <li><img src="img/svg/right-arrow.png" class="list-down">Bishop Stortford
                                </li>
                                <li><img src="img/svg/right-arrow.png" class="list-down">Wickford
                                </li>
                                <li><img src="img/svg/right-arrow.png" class="list-down">Burnham
                                </li>
                                <li><img src="img/svg/right-arrow.png" class="list-down">Rayleigh
                                </li>
                                <li><img src="img/svg/right-arrow.png" class="list-down">Saffron Walden
                                </li>
                                <li><img src="img/svg/right-arrow.png" class="list-down">Grays
                                </li>
                                <li><img src="img/svg/right-arrow.png" class="list-down">Basildon
                                </li>
                                <li><img src="img/svg/right-arrow.png" class="list-down">Romford
                                </li>
                                <li><img src="img/svg/right-arrow.png" class="list-down">Danbury
                                </li>
                                <li><img src="img/svg/right-arrow.png" class="list-down">Dunmow
                                </li>
                                <li><img src="img/svg/right-arrow.png" class="list-down">Halstead
                                </li>
                                <li><img src="img/svg/right-arrow.png" class="list-down">Hockley
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <ul class="biolody-ul pt-2 pb-2">
                                <li><img src="img/svg/right-arrow.png" class="list-down">Ilford
                                </li>
                                <li><img src="img/svg/right-arrow.png" class="list-down">Ingatestone
                                </li>
                                <li><img src="img/svg/right-arrow.png" class="list-down">Rochford
                                </li>
                                <li><img src="img/svg/right-arrow.png" class="list-down">Heybridge
                                </li>
                                <li><img src="img/svg/right-arrow.png" class="list-down">Tollesbury
                                </li>
                                <li><img src="img/svg/right-arrow.png" class="list-down">Kelvedon
                                </li>
                                <li><img src="img/svg/right-arrow.png" class="list-down">Kelvedon Hatch
                                </li>
                                <li><img src="img/svg/right-arrow.png" class="list-down">Stanstead
                                </li>
                                <li><img src="img/svg/right-arrow.png" class="list-down">Sawbridge Worth
                                </li>
                                <li><img src="img/svg/right-arrow.png" class="list-down">Shoeburyness
                                </li>
                                <li><img src="img/svg/right-arrow.png" class="list-down">Benfleet
                                </li>
                                <li><img src="img/svg/right-arrow.png" class="list-down">Springfield
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div> -->

                <!--Course Area Start-->
                <!-- <div class="gray-bgs about-personalize about-top">
                <div class="container">
                    <div class="product-details-content product-top-uk">
                        <div class="section-title-wrapper test width-subject">
                            <div class="section-title ">
                                <p>Subjects and Exam Boards</p>
                            </div>
                        </div>
                        <div class="product-details">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="subject-ul">
                                        <h4>We work with several exam boards including:</h4>
                                        <ul class="biolody-ul pt-2 pb-3">
                                            <li><img src="img/svg/right-arrow.png" class="list-down">Mathematics (Key stage 3 or Junior secondary and GCSE/IGCSE or Key stage 4)
                                            </li>
                                            <li><img src="img/svg/right-arrow.png" class="list-down"> English (Key stage 3 and GCSE/IGCSE or Key stage 4)
                                            </li>
                                            <li><img src="img/svg/right-arrow.png" class="list-down">English Literature (Key stage 3 and GCSE/IGCSE or Key stage 4)
                                            </li>
                                            <li><img src="img/svg/right-arrow.png" class="list-down">Physics (Key stage 3, GCSE/IGCSE or Key stage 4 and A-level or Key stage 5)
                                            </li>
                                            <li><img src="img/svg/right-arrow.png" class="list-down"> Chemistry (Key stage 3, GCSE/IGCSE or Key stage 4 and A-level or Key stage 5)
                                            </li>
                                            <li><img src="img/svg/right-arrow.png" class="list-down">Biology (Key stage 3 and GCSE/IGCSE or Key stage 4)
                                            </li>
                                            <li><img src="img/svg/right-arrow.png" class="list-down"> Combined Science [Key stage 3 and GCSE/IGCSE or Key stage 4)
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="subject-ul">
                                        <h4>Science Clinic Private Tutoring Ltd works with the following Exam boards:
                                        </h4>
                                        <ul class="biolody-ul pt-2 pb-3">
                                            <li><img src="img/svg/right-arrow.png" class="list-down">Pearson Edexcel
                                            </li>
                                            <li><img src="img/svg/right-arrow.png" class="list-down">AQA (Assessment & Qualification Alliance)
                                            </li>
                                            <li><img src="img/svg/right-arrow.png" class="list-down">OCR (Oxford, Cambridge and RSA Exams)
                                            </li>
                                            <li><img src="img/svg/right-arrow.png" class="list-down">Cambridge
                                            </li>
                                            <li><img src="img/svg/right-arrow.png" class="list-down">Welsh Joint Examinations Committee (WJEC)
                                            </li>
                                        </ul>
                                        <p>
                                            The new GCSE grading which is from 9-1 has now been introduced in England and Wales.
                                        </p>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="subject-ul">
                                        <h4>Key stage 3 include the following year groups:</h4>
                                        <ul class="biolody-ul pt-2 pb-3">
                                            <li><img src="img/svg/right-arrow.png" class="list-down">Year 7
                                            </li>
                                            <li><img src="img/svg/right-arrow.png" class="list-down">Year 8
                                            </li>
                                            <li><img src="img/svg/right-arrow.png" class="list-down">Year 9
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="subject-ul">
                                        <h4>Key stage 4 include the following year groups:</h4>
                                        <ul class="biolody-ul pt-2 pb-3">
                                            <li><img src="img/svg/right-arrow.png" class="list-down">Year 10 and Year 11(GCSE/IGCSE)
                                            </li>
                                            <li><img src="img/svg/right-arrow.png" class="list-down">Key stage 5 include the following year groups
                                            </li>
                                            <li><img src="img/svg/right-arrow.png" class="list-down">Year 12 and 13 (A-Level)
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
                <!--End of Course Area-->


                <!-- description details start -->
                <!-- <div class="welcome-about-area bottom-area-about">
                <div class="container">
                    <p class="mb-0 science-text">Science Clinic Private Tutoring Ltd runs a series of holiday revision lessons ahead of key exams. Students are taught by experienced and inspiring tutors, these lessons help students to make overall progress as well as prepare for
                        crucial exams.</p>
                </div>
            </div> -->
                <!-- description details end -->
                <!-- English Testimonials area Start-->
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
                                                            <img src="./img/svg/left-quotes.png" alt="left-quotes">
                                                        </div>
                                                        <div class="max-textquote">
                                                            <p class="mb-0 we-likep">
                                                                We would like to pass on our feedback and show appreciation
                                                                for Mr Hamalabi from Science Clinic Private Tutoring Ltd who
                                                                worked with our daughter and improved her Chemistry &
                                                                Physics skills in the run up to her GCSE exams He was only
                                                                with us for a short
                                                                time but the work he did in that short period of time was
                                                                unbelievable. Kayleigh got A* in both subjects.
                                                            </p>
                                                            <p class="float-right writer-text">
                                                                - B.K. Thomas
                                                            </p>
                                                        </div>
                                                        <div class="quotes-testi testi2">
                                                            <img src="./img/svg/right-quotes.png" alt="right-quotes">
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
                                                            <img src="./img/svg/left-quotes.png" alt="left-quotes">
                                                        </div>
                                                        <div class="max-textquote">
                                                            <p class="mb-0 we-likep">
                                                                Thank you Science Clinic Private Tutoring Ltd for your
                                                                prompt and efficient service. It was so simple, I wish we
                                                                had found you sooner.
                                                            </p>
                                                            <p class="float-right writer-text">
                                                                - C.H. (Colchester)
                                                            </p>
                                                        </div>
                                                        <div class="quotes-testi testi2">
                                                            <img src="./img/svg/right-quotes.png" alt="right-quotes">
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
                                                            <img src="./img/svg/left-quotes.png" alt="left-quotes">
                                                        </div>
                                                        <div class="max-textquote">
                                                            <p class="mb-0 we-likep">
                                                                Can't believe how quickly this has worked. I went on the
                                                                Internet on 15th January and Chloe had a lesson today with
                                                                Mr Hamalabi who is only 5 minutes drive away from us. We are
                                                                so pleased and delighted.
                                                            </p>
                                                            <p class="float-right writer-text">
                                                                - J.J. Brown
                                                            </p>
                                                        </div>
                                                        <div class="quotes-testi testi2">
                                                            <img src="./img/svg/right-quotes.png" alt="right-quotes">
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
                                                            <img src="./img/svg/left-quotes.png" alt="left-quotes">
                                                        </div>
                                                        <div class="max-textquote">
                                                            <p class="mb-0 we-likep">
                                                                I would like you to know how delighted we have been with Mr
                                                                Hamalabi who has provided home tuitions in Physics,
                                                                Mathematics & Chemistry to my daughter for 3 years. She went
                                                                from C grade at the end of year 9 to getting A*, A & A
                                                                respectively in her GCSE.
                                                            </p>
                                                            <p class="float-right writer-text">
                                                                - J.C. Paula
                                                            </p>
                                                        </div>
                                                        <div class="quotes-testi testi2">
                                                            <img src="./img/svg/right-quotes.png" alt="right-quotes">
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
                                                            <img src="./img/svg/left-quotes.png" alt="left-quotes">
                                                        </div>
                                                        <div class="max-textquote">
                                                            <p class="mb-0 we-likep">
                                                                We are grateful to Mr Hamalabi from Science Clinic Private
                                                                Tutoring Ltd for giving Tom confidence and for assisting him
                                                                greatly in improving his performance to the level of getting
                                                                A & A* in Biology, Chemistry & Physics.

                                                            </p>
                                                            <p class="float-right writer-text">
                                                                - C.K. Tommy
                                                            </p>
                                                        </div>
                                                        <div class="quotes-testi testi2">
                                                            <img src="./img/svg/right-quotes.png" alt="right-quotes">
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
                <!-- English Testimonials area End-->


                <div class="sub-data">
                    <div class="about-area gallery-area mt-0">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-8 col-md-12">
                                    <div class="about-container">
                                        <h3>Subjects we offer</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="wrapper">
                                <div class="row">
                                    <div class="col-md-6 col-lg-4">
                                        <a href="mathematics-tuition.html">
                                            <div class="media">
                                                <div class="gall-overlays"></div>
                                                <div class="layer">
                                                    <h2>Mathematics</h2>
                                                </div>
                                                <img src="img/banner/mimg4.jpeg" class="img-over"
                                                    alt="Jenny of Oldstones" />
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <a href="english-language-literature-tuition.html">
                                            <div class="media">
                                                <div class="gall-overlays"></div>
                                                <div class="layer">
                                                    <h2>English Language & Literature</h2>
                                                </div>
                                                <img src="img/banner/eimg3.png" class="img-over"
                                                    alt="Jenny of Oldstones" />
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <a href="physics-tuition.html">
                                            <div class="media">
                                                <div class="gall-overlays"></div>
                                                <div class="layer">
                                                    <h2>Physics</h2>
                                                </div>
                                                <img src="img/banner/pimg5.png" class="img-over"
                                                    alt="Jenny of Oldstones" />
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <a href="biology-tuition.html">
                                            <div class="media">
                                                <div class="gall-overlays"></div>
                                                <div class="layer">
                                                    <h2>Biology</h2>
                                                </div>
                                                <img src="img/banner/bimg1.jpg" class="img-over"
                                                    alt="Jenny of Oldstones" />
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <a href="chemistry-tuition.html">
                                            <div class="media">
                                                <div class="gall-overlays"></div>
                                                <div class="layer">
                                                    <h2>chemistry</h2>
                                                </div>
                                                <img src="img/banner/cimg2.png" class="img-over"
                                                    alt="Jenny of Oldstones" />
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <a href="computer-science.html">
                                            <div class="media">
                                                <div class="gall-overlays"></div>
                                                <div class="layer">
                                                    <h2>Computer Science</h2>
                                                </div>
                                                <img src="img/banner/computer.png" class="img-over"
                                                    alt="Jenny of Oldstones" />
                                            </div>
                                        </a>
                                    </div>

                                    <div class="col-md-6 col-lg-4">
                                        <a href="primary-school.html">
                                            <div class="media">
                                                <div class="gall-overlays"></div>
                                                <div class="layer">
                                                    <h2>Primary
                                                    </h2>
                                                </div>
                                                <img src="img/banner/primary.png" class="img-over"
                                                    alt="Jenny of Oldstones" />
                                            </div>
                                        </a>
                                    </div>

                                    <div class="col-md-6 col-lg-4">
                                        <a href="spanish.html">
                                            <div class="media">
                                                <div class="gall-overlays"></div>
                                                <div class="layer">
                                                    <h2>Languages
                                                    </h2>
                                                </div>
                                                <img src="https://kaleela.com/wp-content/uploads/2021/03/Five-of-the-Top-Foreign-Languages-to-Learn-in-2021-1024x710.png"
                                                    class="img-over" alt="Jenny of Oldstones" />
                                            </div>
                                        </a>
                                    </div>

                                    <div class="col-md-6 col-lg-4">
                                        <a href="history-tuition.html">
                                            <div class="media">
                                                <div class="gall-overlays"></div>
                                                <div class="layer">
                                                    <h2>Other Subjects

                                                    </h2>
                                                </div>
                                                <img src="img/banner/other.png" class="img-over"
                                                    alt="Jenny of Oldstones" />
                                            </div>
                                        </a>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!--Footer Area Start-->
                <div id="footer"></div>
                <!--End of Footer Area-->
        </div>
        <!--End of Bg White-->
    </div>
    <!--End of Main Wrapper Area-->
@endsection
