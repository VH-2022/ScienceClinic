@extends('layouts.frontend')
@section('content')
    <div class="as-mainwrapper">
        <!--Bg White Start-->
        <div class="bg-white">
            <!--Header Area Start-->
            <div id="header"></div>
            <!--End of Header Area-->
        </div>
        <!--End of Breadcrumb Banner Area-->
        <!--Shopping Form Area Start-->
        <div class="shop-grid-area section-padding blog-details-padding">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12 col-lg-10">
                        <div class="detail-guide">
                            <h2>{{ $blog->title }}</h2>
                        </div>
                        <div class="blogdetail-img">
                            <img src="{{ $blog->image }}" alt="">
                            <div class="date-img">
                                <p class="mb-0">
                                    {{ $blog->created_at }}

                                </p>
                            </div>
                        </div>
                        <div class="details-students">
                            <p> {!! $blog->description !!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="details-students">
            </div>
            <!-- English Testimonials area Start-->
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
                                                        <img src="{{ asset('front/img/svg/left-quotes.png') }}"
                                                            alt="left-quotes">
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
                                                        <img src="{{ asset('front/img/svg/right-quotes.png') }}"
                                                            alt="right-quotes">
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
                                                        <img src="{{ asset('front/img/svg/left-quotes.png') }}"
                                                            alt="left-quotes">
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
                                                        <img src="{{ asset('front/img/svg/right-quotes.png') }}"
                                                            alt="right-quotes">
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
                                                        <img src="{{ asset('front/img/svg/left-quotes.png') }}"
                                                            alt="left-quotes">
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
                                                        <img src="{{ asset('front/img/svg/right-quotes.png') }}"
                                                            alt="right-quotes">
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
                                                        <img src="{{ asset('front/img/svg/left-quotes.png') }}"
                                                            alt="left-quotes">
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
                                                        <img src="{{ asset('front/img/svg/right-quotes.png') }}"
                                                            alt="right-quotes">
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
                                                        <img src="{{ asset('front/img/svg/left-quotes.png') }}"
                                                            alt="left-quotes">
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
                                                        <img src="{{ asset('front/img/svg/right-quotes.png') }}"
                                                            alt="right-quotes">
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
        $('.testimonial-english').owlCarousel({
            loop: true,
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
