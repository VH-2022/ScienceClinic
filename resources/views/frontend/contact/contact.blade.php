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
                            <form id="contact-form" action="mail.php" method="post">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="text" name="name" placeholder="Name" id="name">
                                        @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="phone_no" placeholder="Phone No" id="phone_no">
                                        <span class="form-text error phone_error">{{ $errors->first('phone_no') }}</span>
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
                                    </div>
                                    <div class="col-md-6">
                                        <input type="email" name="email" placeholder="Email" id="email">
                                        <span class="form-text error phone_error">{{ $errors->first('email') }}</span>
                                    </div>
                                    <div class="col-md-12">
                                        <textarea name="message" cols="30" rows="10" placeholder="Message" id='massage'></textarea>
                                        <span class="form-text error phone_error">{{ $errors->first('massage') }}</span>
                                        <button type="submit" class="button-default " id="add_contact">SUBMIT</button>
                                    </div>
                                </div>
                            </form>
                            <p class="form-messege"></p>
                        </div>
                    </div>
                </div>
            </div>
            <!--End of Contact Form-->
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
                                                        <img src="{{ asset('img/blog/left-quotes.png') }}"
                                                            alt="left-quotes">
                                                    </div>
                                                    <div class="max-textquote">
                                                        <p class="mb-0 we-likep">
                                                            We would like to pass on our feedback and show appreciation for
                                                            Mr
                                                            Hamalabi from Science Clinic Private Tutoring Ltd who worked
                                                            with
                                                            our
                                                            daughter and improved her Chemistry & Physics skills in the run
                                                            up
                                                            to
                                                            her GCSE exams He was only with us for a short
                                                            time but the work he did in that short period of time was
                                                            unbelievable.
                                                            Kayleigh got A* in both subjects.

                                                        </p>
                                                        <p class="float-right writer-text">
                                                            - B.K. Thomas
                                                        </p>
                                                    </div>
                                                    <div class="quotes-testi testi2">
                                                        <img src="{{ asset('img/blog/right-quotes.png') }}"
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
                                                        <img src="{{ asset('img/blog/left-quotes.png') }}" alt="
                                                            left-quotes">
                                                    </div>
                                                    <div class="max-textquote">
                                                        <p class="mb-0 we-likep">
                                                            Thank you Science Clinic Private Tutoring Ltd for your prompt
                                                            and
                                                            efficient service. It was so simple, I wish we had found you
                                                            sooner.
                                                        </p>
                                                        <p class="float-right writer-text">
                                                            - C.H. (Colchester)
                                                        </p>
                                                    </div>
                                                    <div class="quotes-testi testi2">
                                                        <img src="{{ asset('img/blog/right-quotes.png') }}"
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
                                                        <img src="{{ asset('img/blog/left-quotes.png') }}"
                                                            alt="left-quotes">
                                                    </div>
                                                    <div class="max-textquote">
                                                        <p class="mb-0 we-likep">
                                                            Can't believe how quickly this has worked. I went on the
                                                            Internet on
                                                            15th January and Chloe had a lesson today with Mr Hamalabi who
                                                            is
                                                            only 5
                                                            minutes drive away from us. We are so pleased and delighted.
                                                        </p>
                                                        <p class="float-right writer-text">
                                                            - J.J. Brown
                                                        </p>
                                                    </div>
                                                    <div class="quotes-testi testi2">
                                                        <img src="{{ asset('img/blog/right-quotes.png') }}"
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
                                                        <img src="{{ asset('img/blog/left-quotes.png') }}"
                                                            alt="left-quotes">
                                                    </div>
                                                    <div class="max-textquote">
                                                        <p class="mb-0 we-likep">
                                                            I would like you to know how delighted we have been with Mr
                                                            Hamalabi
                                                            who
                                                            has provided home tuitions in Physics, Mathematics & Chemistry
                                                            to my
                                                            daughter for 3 years. She went from C grade at the end of year 9
                                                            to
                                                            getting A*, A & A respectively in her GCSE.
                                                        </p>
                                                        <p class="float-right writer-text">
                                                            - J.C. Paula
                                                        </p>
                                                    </div>
                                                    <div class="quotes-testi testi2">
                                                        <img src="{{ asset('img/blog/right-quotes.png') }}"
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
                                                        <img src="{{ asset('img/blog/left-quotes.png') }}"
                                                            alt="left-quotes">
                                                    </div>
                                                    <div class="max-textquote">
                                                        <p class="mb-0 we-likep">
                                                            We are grateful to Mr Hamalabi from Science Clinic Private
                                                            Tutoring
                                                            Ltd
                                                            for giving Tom confidence and for assisting him greatly in
                                                            improving
                                                            his
                                                            performance to the level of getting A & A* in Biology, Chemistry
                                                            &
                                                            Physics.
                                                        </p>
                                                        <p class="float-right writer-text">
                                                            - C.K. Tommy
                                                        </p>
                                                    </div>
                                                    <div class="quotes-testi testi2">
                                                        <img src="{{ asset('img/blog/right-quotes.png') }}"
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
            navText: ["<img src='{{ asset('img/blog/left-arrow-test.png') }}'>",
                "<img src='{{ asset('img/blog/right-arrow-test.png') }}'>"
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
     var _Add_SUBJECT = "{{ route('contact-store') }}";
     </script>
      <script>
       $('#add_contact').click(function(e) {
 
             var name = $('#name').val();
             var phone_no = $('#phone_no').val();
             var email = $('#email').val();
             var tutor_type = $('#tutor_type').val();
             var email = $('#email').val();
 
             var temp = 0;
           
             if (name.trim() == '') {
                 $('#name_error').html("Name is required");
                 temp++;
                } else   {
                 $('#name_error').html("");
                 }
 
            
             if (phone_no.trim() == '') {
                 $('#phone_error').html("Description is required");
                temp++;
             } else {
                 $('#phone_error').html("");
             }
                 $.ajax({
                     url: _Add_SUBJECT,
                     type: "POST",
                     data: {
                         _token: '{{csrf_token()}}',
                         name: name,
                      
                     },
                     success: function(response) {
                         console.log(response);
                         toastr.success(response.messages);
                     },
                     error: function(response) {
                         toastr.success(response.messages);
                     }
                 });
             
         })
     </script>
@endsection
