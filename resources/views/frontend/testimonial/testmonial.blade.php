@section('content')
{{-- @Utility:: getAllTestimonialList(); --}}
    <div class="testimonial-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 offset-lg-0 col-md-12 col-12">
                    <div class="owl-carousel owl-theme testimonial-english">
                        <div class="item">

                            <div class="card single-product-item">
                                <div class="card-body single-product-text card-pdtestimonial">
                                    <div class="content-slideeng">
                                        @foreach ($query as $val)
                                            <div class="slider-feedsec">
                                                <div class="quotes-testi testi1">
                                                    <img src="{{ asset('front/img/svg/left-quotes.png') }}"
                                                        alt="left-quotes">
                                                </div>
                                                <div class="max-textquote">
                                                    <p class="mb-0 we-likep">
                                                        <h5>
                                                            @if ($val->description != '')
                                                                {{ Utility::getAllTestimonialList($val->description) }}
                                                            @endif
                                                        </h5>
                                                    </p>
                                                    <p class="float-right writer-text">
                                                        @if ($val->author_name  != '')
                                                        {{ Utility::getAllTestimonialList($val->author_name ) }}
                                                    @endif
                                                    </p>
                                                </div>
                                                <div class="quotes-testi testi2">
                                                    <img src="{{ asset('front/img/svg/right-quotes.png') }}"
                                                        alt="right-quotes">
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
