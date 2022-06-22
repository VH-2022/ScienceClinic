@extends('layouts.frontend')
@section('content')
<div class="backgrount-area book-bg  full-grayoverlay">
    <div class="banner-content padding-headsection">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-content-wrapper text-center full-width">
                        <div class="text-content text-center-content">
                            <h1 class="title1 text-center max-englishtext mb-20">
                                <span class="tlt block" data-in-effect="fadeInRight" data-out-effect="fadeOutRight">Past Examination Papers</span>
                            </h1>

                            <p>
                                Please find below a selection of past examination papers from AQA, Edexcel, Eduqas, OCR Gateway and OCR Twenty First Century examination boards.
                            </p>
                            <div class="banner-readmore">
                                <a class="button-default inline" href="contact.html">CONTACT US</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="gray-bgs past-papperspd res-past-papperspd">
            <div class="container">
                <div>
                    <div class="section-title-wrapper test papers-before middle-title-cap">
                        <div class="section-title">
                            
                            <h3 class="mb-4">Past {{$pastPaperdetail[0]->paper_title}} For {{$pastPaperdetail[0]->subjectData->main_title}} </h3>
                        </div>
                    </div>
                    
               
                    <div class="paper-section">
                        <div class="paper-card">
                            <div class="paper-body">
                                

                                @if(count($pastPaperdetail) > 0)

                                    @foreach($pastPaperdetail as $key)

                                    <div id="accordion">
                                    <div class="card mb-3">
                                      <div class="card-header" id="headingOne">
                                        <p class="mb-0">
                                          <button class="btn btn-link custom-link-coll collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            <span>{{$pastPaperdetail[0]->paper_sub_title}}</span> 
                                          </button>
                                        </p>
                                      </div>
                                  
                                      <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                        <div class="card-body">
                                         
                                            <div class="row">
                                                <div class="col-md-12 col-lg-6">
                                                    <div class="teaching-levels">
                                                       
                                                        <span class="border-width"></span>
                                                       <ul class="past-inner-li">
                                                        @if(count($key->downloadScheme) > 0)
                                                            @foreach($key->downloadScheme as $nkey)
                                                                <li>
                                                                    <div class="past-icon">
                                                                        <i class="fa fa-book mr-2"></i>
                                                                    </div>
                                                                    <div class="past-link-detail">
                                                                        <p>{{$nkey->subject_paper_title}}</p>
                                                                        <div class="past-inner">
                                                                            <a target="_blank" href="{{$nkey->upload_paper}}" download="">Download Paper</a>
                                                                            <a href="{{$nkey->upload_mark_scheme}}" target="_blank" download="">Download Mark Scheme</a>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            @endforeach
                                                        @endif
                                                            
                                                        </ul>
                                                    </div>
                                                </div>
                                        </div>
                                      </div>
                                    </div>
                                </div>

                                    @endforeach

                                @endif

                                
                                  
                            </div>
                        </div>
                        
                    </div>
                    
                  
                </div>
               
               
               
               
                </div>
            </div>
        
        
       
        @include('frontend.subject_offer.subject_offer')
        <!-- English Testimonials area Start-->
        @include('frontend.testimonial.testmonial')
                <!-- English Testimonials area End-->
        <!-- English Testimonials area End-->

    
        <!--Footer Area Start-->
       <div id=" footer">
                                                    </div>
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


                                            <script>
                                                //header footer script
                                                $(document).ready(function() {
                                                    $("#header").load("header.html");
                                                });

                                                $(document).ready(function() {
                                                    $("#footer").load("footer.html");
                                                });
                                            </script>
                                            @endsection