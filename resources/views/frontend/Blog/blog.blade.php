@extends('layouts.frontend')
@section('content')
<style>
    .banner-content,
    .banner-content .container,
    .banner-content .row,
    .banner-content .col-md-12,
    .banner-content .text-content-wrapper,
    .banner-content .text-content {
        height: 50%;
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
                                        <span class="tlt block" data-in-effect="fadeInRight" data-out-effect="fadeOutRight">Blog</span>
                                    </h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Shopping Form Area Start-->
        <div class="shop-grid-area section-padding">
            <div class="container">
                <div class="row">
                    @if (count($blog) > 0)
                    @foreach ($blog as $val)
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="single-product-item">
                            <div class="single-product-image custom-imghgt">
                                <a href="{{ route('blog-detail', $val->id) }}"><img src="{{ $val->image }}" alt=""></a>
                            </div>
                            <div class="single-product-text texttwoline">
                                <a href="{{ route('blog-detail', $val->id) }}">
                                    <h4 class="mb-2">{{ $val->title }}</h4>
                                    <a>
                                        <h5>
                                            @if ($val->created_at != '')
                                            {{ date('F d, Y', strtotime($val->created_at)) }}
                                            @endif
                                        </h5>
                                        <div class="product-price product-price-ellipsis">
                                            <p>
                                                {!! strlen($val->description) > 100 ? substr($val->description, 0, 100) . '...' : $val->description !!}
                                            </p>
                                        </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <div class="row">
                        <div class="col-md-12">
                            <h1>No BlogMaster Data</h1>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- English Testimonials area Start-->
        @include('frontend.testimonial.testmonial')
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